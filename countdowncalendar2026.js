function drawCal() {
  const table = document.getElementById("calendar");
  table.innerHtml = "";

  const start = new Date(2026, 0, 1); // Jan 1, 2026
  const end = new Date(2026, 7, 31); // Aug 31, 2026

  let current = new Date(start);
  let row = document.createElement("tr");
  let block = document.createElement("th");
  table.appendChild(block);

  // JS: Sunday = 0 … Saturday = 6
  // Convert to Monday = 0 … Sunday = 6
  let weekday = (current.getDay() + 6) % 7;

  // Pad the first week
  /*for (let i = 0; i < weekday; i++) {
    row.appendChild(emptyCell());
    }*/

  while (current <= end) {
    if (current.getDate() == 1) {
      block.appendChild(row);
      block = document.createElement("th");
      row = document.createElement("tr");

      let title = document.createElement("h2");
      title.innerText = current.toLocaleString("default", { month: "long" });
      //row.appendChild(title);
      block.appendChild(title);

      //row = document.createElement("tr");

      block.appendChild(row);
      table.appendChild(block);
      for (let i = 0; i < weekday; i++) {
        row.appendChild(emptyCell());
      }
    }

    row.appendChild(dayCell(current));

    weekday++;

    if (weekday === 7) {
      block.appendChild(row);
      row = document.createElement("tr");
      weekday = 0;
    }

    current.setDate(current.getDate() + 1);
  }

  // Pad the final row
  if (weekday !== 0) {
    for (let i = weekday; i < 7; i++) {
      row.appendChild(emptyCell());
    }
    block.appendChild(row);
  }

  function dayCell(day) {
    const th = document.createElement("th");
    th.className = "cal-entry";

    if (day <= new Date(2026, 0, 7) || day >= new Date(2026, 7, 6)) {
      th.classList.add("cal-oos");
    } else if (
      day.getDate() == new Date().getDate() &&
      day.getMonth() == new Date().getMonth()
    ) {
      th.classList.add("cal-today");
    } else if (day < new Date()) {
      th.classList.add("cal-before");
    } else if (day > new Date()) {
      th.classList.add("cal-after");
    }

    const p = document.createElement("p");
    p.textContent = day.getDate();

    th.appendChild(p);
    return th;
  }

  function emptyCell() {
    const th = document.createElement("th");
    th.className = "cal-entry";

    const p = document.createElement("p");
    p.innerHTML = "<br>";

    th.appendChild(p);
    return th;
  }
}

function daysUntil() {
  return Math.floor((new Date(2026, 7, 5) - new Date()) / 86400000) + 1;
}

document.addEventListener("DOMContentLoaded", () => {
  drawCal();
  document.getElementById("counter").innerText =
    daysUntil() + " Days until August 5th, 2026";
});
