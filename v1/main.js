async function showNotes() {
    let res = await fetch ('http://api/v1/notebook');
    let notes = await res.json();


    console.log(notes);
    notes.forEach((note) => {
        document.querySelector('.note-list').innerHTML += `
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h4 class="card-title">Запись №${note.id}</h4>
                    <p class="card-text">ФИО: ${note.name}</p>
                    <p class="card-text">Компания: ${note.company || "Нет информации"}</p>
                    <p class="card-text">Телефон: ${note.phone_number}</p>
                    <p class="card-text">Email: ${note.email || "Нет информации"}</p>
                    <p class="card-text">Дата рождения: ${note.birth_date || "Нет информации"}</p
                 </div>
            </div>
        `
        
    });
}

showNotes();