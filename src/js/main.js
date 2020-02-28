'use strict';

const url = 'http://localhost/old/mom5v2/courselist.php/courses';

//Händelsehanterare
window.onload = getCourses;
document.getElementById('formBtn').addEventListener('click', addCourse);

//Hämtar alla kurser och skriver ut dessa
function getCourses() {
  //Använder fetch för att hämta JSON
  fetch(url)
    .then(response => response.json())
    .then(data => {
      //Varje element i JSON-fil skrivs ut i tabellen med hjälp av en forEach-loop
      data.forEach(course => {
        output += `<tr><td>${course.code}</td><td>${course.namn}</td><td>${course.progression}</td><td>
        <a href='${course.syllabus}' title='Kursplan för ${course.code}' target='_blank'>Webblänk</a></td></tr>`;
      });
      document.getElementById('coursesOutput').innerHTML = output;
    })
};

//Lägger till en kurs
function addCourse() {
  //Värden i inmatningsfälten sparas i variabler
  let code = document.getElementById('c_code').value;
  let namn = document.getElementById('c_namn').value;
  let progression = document.getElementById('c_progression').value;
  let syllabus = document.getElementById('c_syllabus').value;

  //Kontroll av innehållet i inmatningsfälten. Är de tomma skrivs ett felmeddelande ut, är dem inte det sparas informationen
  if (
    code == '' ||
    (code == null && namn == '') ||
    (namn == null && progression == '') ||
    (progression == null && syllabus == '') ||
    syllabus == null
  ) {
    document.getElementById('msg').innerHTML = 'Fyll i alla fält!';
  } else {
    let jsonStr = JSON.stringify({
      code: code,
      namn: namn,
      progression: progression,
      syllabus: syllabus
    });


    fetch(url, {
      method: 'POST',
      body: jsonStr
    })
      .then(res => res.json())
      .then(data => location.reload(true))
      .catch(err => console.log(err));
  }
}
