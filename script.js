function addTask() {
    const input = document.getElementById("taskInput");
    const text = input.value.trim();

    if (text !== "") {
        const taskList = document.getElementById("taskList");

        // Buat kontainer baris tugas
        const taskItem = document.createElement("div");
        taskItem.className = "task-item";

        // Buat teks tugas
        const taskText = document.createElement("div");
        taskText.className = "task-text";
        taskText.textContent = text;

        // Buat tombol-tombol aksi
        const buttonsDiv = document.createElement("div");
        buttonsDiv.className = "task-buttons";

        const doneButton = document.createElement("button");
        doneButton.textContent = "Selesai";
        doneButton.onclick = () => {
            taskText.style.textDecoration = "line-through";
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
