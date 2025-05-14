function addTask() {
    const input = document.getElementById("taskInput");
    const text = input.value.trim();

    if (text !== "") {
        const taskList = document.getElementById("taskList");

        // Buat kontainer baris tugas
        const taskItem = document.createElement("div");
        taskItem.className = "task-item";

        // Buat input field readonly untuk teks to-do
        const taskText = document.createElement("input");
        taskText.type = "text";
        taskText.value = text;
        taskText.readOnly = true;
        taskText.className = "task-text";

        // Buat tombol aksi
        const buttonsDiv = document.createElement("div");
        buttonsDiv.className = "task-buttons";

        const doneButton = document.createElement("button");
        doneButton.textContent = "Selesai";
        doneButton.onclick = () => {
            taskText.classList.toggle("completed");
        };

        const deleteButton = document.createElement("button");
        deleteButton.textContent = "Hapus";
        deleteButton.onclick = () => {
            taskList.removeChild(taskItem);
        };

        buttonsDiv.appendChild(doneButton);
        buttonsDiv.appendChild(deleteButton);

        taskItem.appendChild(taskText);
        taskItem.appendChild(buttonsDiv);
        taskList.appendChild(taskItem);

        input.value = "";
    }
}
