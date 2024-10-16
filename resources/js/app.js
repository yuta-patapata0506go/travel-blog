import 'bootstrap';

document.addEventListener("DOMContentLoaded", function() {
  const weeks = ['日', '月', '火', '水', '木', '金', '土'];

  const date = new Date();
  let year = date.getFullYear();
  let month = date.getMonth() + 1;  
  let today = date.getDate();

  const renderCalendar = () => {
      const startDate = new Date(year, month - 1, 1);
      const endDate = new Date(year, month, 0);
      const endDayCount = endDate.getDate();
      const startDay = startDate.getDay();

      let dayCount = 1;
      let calendarHtml = ''; 

      document.getElementById('month-year').textContent = year + '年 ' + month + '月';

      calendarHtml += '<tr>';

      for (let w = 0; w < 6; w++) {
          for (let d = 0; d < 7; d++) {
              if (w === 0 && d < startDay) {
                  calendarHtml += '<td></td>';
              } else if (dayCount > endDayCount) {
                  calendarHtml += '<td></td>';
              } else {
                  if (dayCount === today && month === (new Date().getMonth() + 1) && year === new Date().getFullYear()) {
                      calendarHtml += "<td class='today'>" + dayCount + "</td>";
                  } else {
                      calendarHtml += '<td>' + dayCount + '</td>';
                  }
                  dayCount++;
              }
          }
          calendarHtml += '</tr><tr>';
      }

      calendarHtml += '</tr>';
      document.querySelector('#calendar-body').innerHTML = calendarHtml;
  }

  document.getElementById('prev-month').addEventListener('click', () => {
      month--;
      if (month < 1) {
          month = 12;
          year--;
      }
      renderCalendar();
  });

  document.getElementById('next-month').addEventListener('click', () => {
      month++;
      if (month > 12) {
          month = 1;
          year++;
      }
      renderCalendar();
  });

  renderCalendar();
});