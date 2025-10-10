<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
  "http://www.w3.org/TR/html4/loose.dtd">
<html >
<head><title>Cross-language inlining on GPU through LLVM</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="generator" content="TeX4ht (https://tug.org/tex4ht/)">
<meta name="originator" content="TeX4ht (https://tug.org/tex4ht/)">
<!-- html -->
<meta name="src" content="paper.tex">
<link rel="stylesheet" type="text/css" href="2025confpaper-styles.css">
    <?php include $_SERVER["DOCUMENT_ROOT"] . "/titlebar.php"; ?>

</head><body
>
   <div class="content">
    <div class="maketitle">






<h2 class="titleHead">Cross-language inlining on GPU through LLVM</h2>
<div class="author" ><span
class="cmr-12">Allen MacFarland, Jed Brown, Jeremy Thompson</span></div><br />
<div class="date" ><span
class="cmr-12"></span></div>
   </div>
   <div
class="abstract"
>
   <h3 class="abstracttitle">
<span
class="cmbx-9">Abstract</span>
</h3>
     <!--l. 72--><p class="noindent" ><span
class="cmr-9">I  introduce  a  method  of  inlining  functions  from  an  external  programming  language  by  individually</span>
     <span
class="cmr-9">manipulating the steps of LLVM compilation. Despite slightly slower compilations, it yields almost identical</span>
     <span
class="cmr-9">runtime performance to single-language alternative compilation schemes. Intended for developers who wish</span>
     <span
class="cmr-9">to integrate cross-language inlining into their own systems.</span>
</div>
   <h3 class="sectionHead"><span class="titlemark">1   </span> <a
 id="x1-10001"></a>Introduction</h3>
<!--l. 77--><p class="noindent" >I have been working on a C library called <span
class="cmtt-10">libCEED</span>, which provides an efficient framework for matrix-free discretizations
on CPU and GPU. This library requires users to write a small C function to define their mathematical operators; I
changed this to allow users to write this function in Rust, and this paper will explain how this compilation scheme
works in enough detail for anyone wishing to do the same between any other LLVM-based languages. While this frames
why I needed to do this work, it is not the focus of this paper, which should be applicable to anyone interested in GPU
compilation. For a reference implementation of the method described in this paper, please see the <a
href="https://github.com/CEED/libCEED" ><span
class="cmtt-10">libCEED </span>source
code</a>.<br
class="newline" />
   <div class="wrapfig-r"><!--l. 81-->
<pre class="lstlisting" id="listing-1"><span class="label"><a
 id="x1-1001r1"></a></span><span style="color:#000000"><span
class="cmtt-9">//</span></span><span style="color:#000000"> </span><span style="color:#000000"><span
class="cmtt-9">Two</span></span><span style="color:#000000"> </span><span style="color:#000000"><span
class="cmtt-9">functions</span></span><span style="color:#000000"> </span><span style="color:#000000"><span
class="cmtt-9">before</span></span><span style="color:#000000"> </span><span style="color:#000000"><span
class="cmtt-9">inlining</span></span><span style="color:#000000"><span
class="cmtt-9">...</span></span>
<span class="label"><a
 id="x1-1002r2"></a></span><span style="color:#000000"><span
class="cmtt-9">fn</span></span><span style="color:#000000"> </span><span style="color:#000000"><span
class="cmtt-9">calculate_position</span></span><span style="color:#000000"><span
class="cmtt-9">(</span></span><span style="color:#000000"><span
class="cmtt-9">t</span></span><span style="color:#000000"><span
class="cmtt-9">:</span></span><span style="color:#000000"> </span><span style="color:#000000"><span
class="cmtt-9">i32</span></span><span style="color:#000000"><span
class="cmtt-9">)</span></span><span style="color:#000000"> </span><span style="color:#000000"><span
class="cmtt-9">-&#x003E;</span></span><span style="color:#000000"> </span><span style="color:#000000"><span
class="cmtt-9">i32</span></span><span style="color:#000000"> </span><span style="color:#000000"><span
class="cmtt-9">{</span></span>
<span class="label"><a
 id="x1-1003r3"></a></span><span
class="cmtt-9">&#x00A0;</span><span
class="cmtt-9">&#x00A0;</span><span
class="cmtt-9">&#x00A0;</span><span style="color:#0000FF"><span
class="cmtt-9">return</span></span><span style="color:#000000"> </span><span style="color:#000000"><span
class="cmtt-9">square</span></span><span style="color:#000000"><span
class="cmtt-9">(</span></span><span style="color:#000000"><span
class="cmtt-9">t</span></span><span style="color:#000000"><span
class="cmtt-9">)</span></span><span style="color:#000000"> </span><span style="color:#000000"><span
class="cmtt-9">+</span></span><span style="color:#000000"> </span><span style="color:#000000"><span
class="cmtt-9">t</span></span><span style="color:#000000"> </span><span style="color:#000000"><span
class="cmtt-9">-</span></span><span style="color:#000000"> </span><span style="color:#000000"><span
class="cmtt-9">5;</span></span>
<span class="label"><a
 id="x1-1004r4"></a></span><span style="color:#000000"><span
class="cmtt-9">}</span></span>
<span class="label"><a
 id="x1-1005r5"></a></span><span style="color:#000000"><span
class="cmtt-9">fn</span></span><span style="color:#000000"> </span><span style="color:#000000"><span
class="cmtt-9">square</span></span><span style="color:#000000"><span
class="cmtt-9">(</span></span><span style="color:#000000"><span
class="cmtt-9">x</span></span><span style="color:#000000"><span
class="cmtt-9">:</span></span><span style="color:#000000"> </span><span style="color:#000000"><span
class="cmtt-9">i32</span></span><span style="color:#000000"><span
class="cmtt-9">)</span></span><span style="color:#000000"> </span><span style="color:#000000"><span
class="cmtt-9">-&#x003E;</span></span><span style="color:#000000"> </span><span style="color:#000000"><span
class="cmtt-9">i32</span></span><span style="color:#000000"> </span><span style="color:#000000"><span
class="cmtt-9">{</span></span>
<span class="label"><a
 id="x1-1006r6"></a></span><span
class="cmtt-9">&#x00A0;</span><span
class="cmtt-9">&#x00A0;</span><span
class="cmtt-9">&#x00A0;</span><span style="color:#0000FF"><span
class="cmtt-9">return</span></span><span style="color:#000000"> </span><span style="color:#000000"><span
class="cmtt-9">x</span></span><span style="color:#000000"> </span><span style="color:#000000"><span
class="cmtt-9">*</span></span><span style="color:#000000"> </span><span style="color:#000000"><span
class="cmtt-9">x</span></span><span style="color:#000000"><span
class="cmtt-9">;</span></span>
<span class="label"><a
 id="x1-1007r7"></a></span><span style="color:#000000"><span
class="cmtt-9">}</span></span>
<span class="label"><a
 id="x1-1008r8"></a></span>
<span class="label"><a
 id="x1-1009r9"></a></span><span style="color:#000000"><span
class="cmtt-9">//</span></span><span style="color:#000000"> </span><span style="color:#000000"><span
class="cmtt-9">...</span></span><span style="color:#000000"><span
class="cmtt-9">turn</span></span><span style="color:#000000"> </span><span style="color:#000000"><span
class="cmtt-9">into</span></span><span style="color:#000000"> </span><span style="color:#000000"><span
class="cmtt-9">one</span></span><span style="color:#000000"> </span><span style="color:#000000"><span
class="cmtt-9">function</span></span><span style="color:#000000"> </span><span style="color:#000000"><span
class="cmtt-9">after</span></span><span style="color:#000000"> </span><span style="color:#000000"><span
class="cmtt-9">inlining</span></span>
<span class="label"><a
 id="x1-1010r10"></a></span><span style="color:#000000"><span
class="cmtt-9">fn</span></span><span style="color:#000000"> </span><span style="color:#000000"><span
class="cmtt-9">calculate_position</span></span><span style="color:#000000"><span
class="cmtt-9">(</span></span><span style="color:#000000"><span
class="cmtt-9">t</span></span><span style="color:#000000"><span
class="cmtt-9">:</span></span><span style="color:#000000"> </span><span style="color:#000000"><span
class="cmtt-9">i32</span></span><span style="color:#000000"><span
class="cmtt-9">)</span></span><span style="color:#000000"> </span><span style="color:#000000"><span
class="cmtt-9">-&#x003E;</span></span><span style="color:#000000"> </span><span style="color:#000000"><span
class="cmtt-9">i32</span></span><span style="color:#000000"> </span><span style="color:#000000"><span
class="cmtt-9">{</span></span>
<span class="label"><a
 id="x1-1011r11"></a></span><span
class="cmtt-9">&#x00A0;</span><span
class="cmtt-9">&#x00A0;</span><span
class="cmtt-9">&#x00A0;</span><span style="color:#0000FF"><span
class="cmtt-9">return</span></span><span style="color:#000000"> </span><span style="color:#000000"><span
class="cmtt-9">(</span></span><span style="color:#000000"><span
class="cmtt-9">t</span></span><span style="color:#000000"> </span><span style="color:#000000"><span
class="cmtt-9">*</span></span><span style="color:#000000"> </span><span style="color:#000000"><span
class="cmtt-9">t</span></span><span style="color:#000000"><span
class="cmtt-9">)</span></span><span style="color:#000000"> </span><span style="color:#000000"><span
class="cmtt-9">+</span></span><span style="color:#000000"> </span><span style="color:#000000"><span
class="cmtt-9">t</span></span><span style="color:#000000"> </span><span style="color:#000000"><span
class="cmtt-9">-</span></span><span style="color:#000000"> </span><span style="color:#000000"><span
class="cmtt-9">5;</span></span>
<span class="label"><a
 id="x1-1012r12"></a></span><span style="color:#000000"><span
class="cmtt-9">}</span></span></pre>
Figure 1: A rust-style pseudocode example of inlining </div>
<!--l. 98--><p class="indent" >   Inlining is a type of compile-time optimization where two functions can be combined into one (Figure 1). This
reduces function calls, which is especially important when compiling to GPU targets, where function calls are incredibly
expensive.<br
class="newline" />
<!--l. 100--><p class="indent" >   Typically, automatic inlining optimizations stay within language barriers, and it was generally accepted that
cross-language calls should not be done in very performance-critical sections of code. However, thanks to intermediate
representations (IR) of languages, it is now possible to inline across language barriers which have previously effectively
blocked cross-language GPU calls.<br
class="newline" />
<!--l. 102--><p class="indent" >   IR was designed to be an intermediary step between languages and targets, such that not every language needed to
write a compiler to every target; Languages could simply compile to LLVM, the largest IR, where they would get access
to every target. However, this compiler design comes with a hidden benefit: it is possible to combine
languages through LLVM IR and optimize with knowledge of the entire codebase, including multiple
languages.<br
class="newline" />
<!--l. 104--><p class="indent" >   <a
href="https://clang.llvm.org/" ><span
class="cmtt-10">clang </span>and <span
class="cmtt-10">clang++</span></a> are LLVM-based C and C++ compilers that are closely tied with development of the LLVM IR.
<a
href="https://www.rust-lang.org/" >Rust</a> is a modern programming language with an LLVM-based compiler <span
class="cmtt-10">rustc </span>and package manager <span
class="cmtt-10">cargo</span>, where
packages are organized as &#8220;crates&#8221;.


<!--l. 106--><p class="noindent" >
   <h3 class="sectionHead"><span class="titlemark">2   </span> <a
 id="x1-20002"></a>The Pipeline</h3>
<!--l. 107--><p class="noindent" ><img
src="images/2025confpaper-general-diagram.svg" alt="Flowchart showing the compilation pipeline from Rust and C++ to GPU code. The top path labeled Device function starts with \"Rust\" → \"cargo\" → \"LLVM\". The bottom path labeled GPU Kernel starts with \"C++\" → \"clang\" → \"LLVM\". Both LLVM outputs merge using \"llvm-link\" into a single LLVM node. That LLVM code is then processed by \"opt\" (optimization) producing another LLVM output, which is passed to \"llc\" to generate \"GPU code\".
" ><br
class="newline" />Figure 2: A diagram of the compilation scheme.<br
class="newline" />
<!--l. 139--><p class="noindent" >Our approach to compilation is to split the compilation into each of the traditional LLVM compilation steps
and add the Rust LLVM as though it were part of a regular single-language LTO compile; see Figure
2.<br
class="newline" />
<!--l. 141--><p class="indent" >   In other words, the Rust and C++ are individually compiled first to LLVM with their respective
compilers, then both of these LLVM files are linked with <span
class="cmtt-10">llvm-link</span>, optimized (including inlining) with
<span
class="cmtt-10">opt</span>, and finally compiled to gpu code with <span
class="cmtt-10">llc</span>. This produces a <span
class="cmtt-10">.ptx </span>file which can be fed directly into
CUDA.
<!--l. 143--><p class="noindent" >
   <h3 class="sectionHead"><span class="titlemark">3   </span> <a
 id="x1-30003"></a>Potential Pitfalls and Limitations</h3>
<!--l. 144--><p class="noindent" >When working on manual LLVM compilation systems like these, there are a number of problems that special care must
be taken to avoid. Three of them are described here<br
class="newline" />
<!--l. 146--><p class="noindent" >
   <h4 class="subsectionHead"><span class="titlemark">3.1   </span> <a
 id="x1-40003.1"></a>Generating Valid LLVM Output</h4>
<!--l. 147--><p class="noindent" >Many programming languages that allow LLVM output only intended their LLVM outputs to be used for debugging,
and never considered that it could instead be routed into a compilation pipeline. This may lead to unforeseen problems,
depending on the programming language. <br
class="newline" />
<!--l. 149--><p class="indent" >   For example, in Rust, the well-documented <span
class="cmtt-10">--emit=llvm-ir </span>API is not capable of emitting dependencies, including
<span
class="cmtt-10">core </span>or <span
class="cmtt-10">std</span>, at least one of which is required for compilation of almost anything. Instead, developers must use
the <span
class="cmtt-10">linker-plugin-lto </span>rustflag and <span
class="cmtt-10">build-std </span>nightly feature to generate a <span
class="cmtt-10">staticlib</span>. Among other
things, this contains the LLVM bitcode, so it must be passed to <span
class="cmtt-10">llvm-link </span>with the <span
class="cmtt-10">ignore-non-bitcode</span>
flag.
<!--l. 151--><p class="noindent" >
   <h4 class="subsectionHead"><span class="titlemark">3.2   </span> <a
 id="x1-50003.2"></a>LLVM Version Mismatches</h4>
<!--l. 152--><p class="noindent" >New versions of LLVM are frequently released, and they are not backwards-compatible. This means that the entire
pipeline must run the same version of LLVM, including compilers for other languages. For example, Rust nightly
frequently updates their LLVM toolchain and maintains their own slightly modified branch, so the entire <span
class="cmtt-10">libCEED</span>
pipeline depends on the Rust-provided LLVM tools. <br
class="newline" />
<!--l. 154--><p class="indent" >   Those who wish to implement this system with another programming language should take care to ensure that the
LLVM versions of all relevant tools match. Version mismatches <span
class="cmbx-10">do not trigger version mismatch errors</span>, and may
appear to be an entirely unrelated error. Additionally, it is possible to get &#8220;lucky&#8221; with LLVM versions and have LLVM
generated in one version work in another. This is never recommended because small configuration changes could break
code in hard-to-trace ways.<br
class="newline" />
<!--l. 156--><p class="indent" >   While it would be convenient for LLVM to be a stable platform to target for cross-compilation, this is not one of the
goals of their project and is unlikely to change soon. Developers using LLVM in this way should be aware that this is
not the intended use of the LLVM tools.
<!--l. 158--><p class="noindent" >
   <h4 class="subsectionHead"><span class="titlemark">3.3   </span> <a
 id="x1-60003.3"></a>Distro Support for new LLVM Versions</h4>
<!--l. 159--><p class="noindent" >Many distros ship only an outdated version of LLVM, which can cause frustrations for users with incompatible distros.
<br
class="newline" />
<!--l. 161--><p class="indent" >   For example, Rust is typically installed with a standalone script that gets the latest version, regardless of distro,
and our build method relies on the nightly release channel of Rust; at the time of writing, Ubuntu LTS
only ships LLVM version 19, even though Rust uses LLVM version 20. Because we require the nightly
release channel for the <span
class="cmtt-10">build-std </span>feature (and this is never expected to land in stable), and it&#8217;s not
reasonable to use an older version of Rust nightly, our solution is effectively limited to bleeding-edge
distros.
<!--l. 163--><p class="noindent" >
   <h3 class="sectionHead"><span class="titlemark">4   </span> <a
 id="x1-70004"></a>Performance</h3>
<!--l. 165--><p class="noindent" >In <span
class="cmtt-10">libCEED</span>, GPU compilation is done Just-in-Time (JiT), so the cost of compilation is included in the cost of runtime
execution. It can be compared to a reference implementation with the proprietary <span
class="cmtt-10">nvrtc </span>compiler and to a
single-language variant of the <span
class="cmtt-10">clang </span>compile process<br
class="newline" />
<!--l. 167--><p class="indent" >   <hr class="figure"><div class="figure"
>




<div class="fbox"> <img
src="images/perf-diagram-v1-light.svg" alt="Line graph titled “Performance of LibCEED benchmark by language and build process.” It shows execution time (in seconds, lower is better) versus problem difficulty (in millions of unknowns). Three lines represent different build configurations: NVRTC/C++ (blue squares), Clang/C++ (red diamonds), and Clang/Rust/C++ (yellow triangles). The NVRTC/C++ line consistently achieves the lowest execution times, remaining around 10–30 seconds. The Clang/C++ and Clang/Rust/C++ lines follow similar trends but are consistently slower, staying roughly 5–10 seconds higher. The benchmark was run on an AMD EPYC 7452/NVIDIA A30 system."
width="483" height="271" ></div>
<!--l. 170--><p class="noindent" >Figure 3: A performance benchmark comparing the new compile and execution time of the new compilation scheme
relative to 2 possible controls: a single-language compilation scheme with the same compiler, and the proprietary
<span
class="cmtt-10">nvrtc</span>


<!--l. 171--><p class="indent" >   </div><hr class="endfigure">
<!--l. 174--><p class="indent" >   As shown in Figure 3, <span
class="cmtt-10">clang </span>takes longer to compile, but this is only an <span
class="cmmi-10">O</span>(1) cost, so as the problem size increases,
the relative gap between all implementations decreases.
   <h3 class="sectionHead"><span class="titlemark">5   </span> <a
 id="x1-80005"></a>Conclusion</h3>
<!--l. 178--><p class="noindent" >Combining languages with LLVM is a promising new compilation technique, especially on GPU targets, where inlining
is essential. <br
class="newline" />
<!--l. 180--><p class="indent" >   The process described here for inlining Rust device functions into C++ kernels should be roughly applicable to
inlining between any two LLVM-based languages. Further work could be done on implementing such
integrations.<br
class="newline" />
<!--l. 182--><p class="indent" >   Further work could also be done on improving the pain points described in section 3 on the LLVM side. Improving
LLVM error messages or committing to a more stable IR could significantly simplify development of many
integrations.
<!--l. 184--><p class="noindent" >
   <h3 class="sectionHead"><span class="titlemark">6   </span> <a
 id="x1-90006"></a>Acknowledgments</h3>
<!--l. 185--><p class="noindent" >This work was funded by the United States Department of Energy
     <ul class="itemize1">
     <li class="itemize">
     <!--l. 187--><p class="noindent" ><a
href="https://psaap.llnl.gov/" >PSAAP - Predictive Science Academic Alliance Program</a>
     </li>
     <li class="itemize">
     <!--l. 188--><p class="noindent" ><a
href="https://scidac.gov/" >SciDAC - Scientific Discovery through Advanced Computing</a>
     </li>
     <li class="itemize">
     <!--l. 189--><p class="noindent" ><a
href="https://www.exascaleproject.org/" >Exascale computing project</a></li></ul>
<!--l. 191--><p class="noindent" >This work was completed by an undergraduate researcher funded by the <a
href="https://www.colorado.edu/engineering/students/research-opportunities/summer-program-undergraduate-research-cu-spur" >SPUR program</a> of the University of Colorado
Boulder, funded by the <a
href="https://www.colorado.edu/program/eef/" >Engineering Excellence Fund</a>
<!--l. 195--><p class="noindent" >
   <h3 class="sectionHead"><a
 id="x1-10000"></a>References</h3>
<!--l. 195--><p class="noindent" >
         <dl class="thebibliography"><dt id="X0-llvm" class="thebibliography">
[03]      </dt><dd
id="bib-1" class="thebibliography">
         <!--l. 195--><p class="noindent" ><a
 id="cite.0@llvm"></a><span
class="cmti-10">LLVM</span>. <a
href="https://llvm.org/" class="url" ><span
class="cmtt-10">https://llvm.org/</span></a>. 2003. <span
class="cmcsc-10"><span
class="small-caps">u</span><span
class="small-caps">r</span><span
class="small-caps">l</span></span>: <a
href="https://llvm.org/" class="url" ><span
class="cmtt-10">https://llvm.org/</span></a>.
         </dd><dt id="X0-LLVM:CGO04" class="thebibliography">
[LA04]    </dt><dd
id="bib-2" class="thebibliography">
         <!--l. 195--><p class="noindent" ><a
 id="cite.0@LLVM:CGO04"></a>Chris Lattner and Vikram Adve. &#8220;LLVM: A Compilation Framework for Lifelong Program Analysis
         and Transformation&#8221;. In: San Jose, CA, USA, Mar. 2004, pp.&#x00A0;75&#8211;88.
         </dd><dt id="X0-clang" class="thebibliography">
[07]      </dt><dd
id="bib-3" class="thebibliography">
         <!--l. 195--><p class="noindent" ><a
 id="cite.0@clang"></a><span
class="cmti-10">Clang</span>. <a
href="https://clang.llvm.org/" class="url" ><span
class="cmtt-10">https://clang.llvm.org/</span></a>. 2007. <span
class="cmcsc-10"><span
class="small-caps">u</span><span
class="small-caps">r</span><span
class="small-caps">l</span></span>: <a
href="https://clang.llvm.org/" class="url" ><span
class="cmtt-10">https://clang.llvm.org/</span></a>.
         </dd><dt id="X0-rust-lang" class="thebibliography">
[15]      </dt><dd
id="bib-4" class="thebibliography">
         <!--l. 195--><p class="noindent" ><a
 id="cite.0@rust-lang"></a><span
class="cmti-10">The   Rust   Programming   Language</span>.   <a
href="https://www.rust-lang.org/" class="url" ><span
class="cmtt-10">https://www.rust-lang.org/</span></a>.   2015.   <span
class="cmcsc-10"><span
class="small-caps">u</span><span
class="small-caps">r</span><span
class="small-caps">l</span></span>:
<a
href="https://www.rust-lang.org/" class="url" ><span
class="cmtt-10">https://www.rust-lang.org/</span></a>.


         </dd><dt id="X0-libceed-joss-paper" class="thebibliography">
[Bro+21]  </dt><dd
id="bib-5" class="thebibliography">
         <!--l. 195--><p class="noindent" ><a
 id="cite.0@libceed-joss-paper"></a>Jed Brown et al. &#8220;libCEED: Fast algebra for high-order element-based discretizations&#8221;. In: <span
class="cmti-10">Journal</span>
         <span
class="cmti-10">of Open Source Software </span>6.63 (2021), p.&#x00A0;2945. <span
class="cmcsc-10"><span
class="small-caps">d</span><span
class="small-caps">o</span><span
class="small-caps">i</span></span>: <a
href="https://doi.org/10.21105/joss.02945" ><span
class="cmtt-10">10.21105/joss.02945</span></a>.
         </dd><dt id="X0-libceed-dev-site" class="thebibliography">
[21]      </dt><dd
id="bib-6" class="thebibliography">
         <!--l. 195--><p class="noindent" ><a
 id="cite.0@libceed-dev-site"></a><span
class="cmti-10">libCEED   development   site</span>.    <a
href="https://github.com/ceed/libceed" class="url" ><span
class="cmtt-10">https://github.com/ceed/libceed</span></a>.    2021.    <span
class="cmcsc-10"><span
class="small-caps">u</span><span
class="small-caps">r</span><span
class="small-caps">l</span></span>:
<a
href="https://github.com/ceed/libceed" class="url" ><span
class="cmtt-10">https://github.com/ceed/libceed</span></a>.</dd></dl>
<div class="content">
</body></html>
