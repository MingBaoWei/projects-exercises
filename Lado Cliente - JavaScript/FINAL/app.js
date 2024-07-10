// Arrays para almacenar los libros, usuarios y admins
let books = [
    { category: "comedia", title: "El amor en los tiempos del cólera", author: "Gabriel García Márquez" },
    { category: "comedia", title: "Don Quijote de la Mancha", author: "Miguel de Cervantes" },
    { category: "comedia", title: "Orgullo y prejuicio", author: "Jane Austen" },
    { category: "terror", title: "IT", author: "Stephen King" },
    { category: "terror", title: "Drácula", author: "Bram Stoker" },
    { category: "terror", title: "El resplandor", author: "Stephen King" },
    { category: "romance", title: "Cien años de soledad", author: "Gabriel García Márquez" },
    { category: "romance", title: "Romeo y Julieta", author: "William Shakespeare" },
    { category: "romance", title: "La ladrona de libros", author: "Markus Zusak" },
    { category: "drama", title: "Los miserables", author: "Victor Hugo" },
    { category: "drama", title: "El diario de Ana Frank", author: "Ana Frank" },
    { category: "drama", title: "La casa de los espíritus", author: "Isabel Allende" }
];

let users = ['usuario', 'wei'];
let admins = ['administrador', 'maite'];

// Función para iniciar sesión
function login() {
    let username = document.getElementById('username').value;
    let userType = getUserType(username);
    
    if (userType === 'admin') {
        document.getElementById('searchInput').style.display = 'block';
        document.getElementById('books').style.display = 'block';
        document.getElementById('loginForm').style.display = 'none';
        document.getElementById('addBookForm').style.display = 'block';
        document.getElementById('1').style.display = 'none';
        displayBooks();
    } else if (userType === 'user') {
        document.getElementById('searchInput').style.display = 'block';
        document.getElementById('books').style.display = 'block';
        document.getElementById('loginForm').style.display = 'none';
        document.getElementById('1').style.display = 'none';
        displayBooks();
    } else {
        alert('Usuario incorrecto');
    }
}


// Función para obtener el tipo de usuario (admin o usuario normal)
function getUserType(username) {
    if (admins.includes(username)) {
        return 'admin';
    } else if (users.includes(username)) {
        return 'user';
    } else {
        return 'invalid';
    }
}

// Función para agregar un libro
function addBook() {
    let title = document.getElementById('title').value;
    let author = document.getElementById('author').value;
    let category = document.getElementById('category').value;

    // Validación de campos
    if (title.trim() === '' || author.trim() === '') {
        alert('Por favor, complete todos los campos');
        return;
    }

    let book = { title: title, author: author, category: category };
    books.push(book);

    document.getElementById('title').value = '';
    document.getElementById('author').value = '';

    displayBooks();
}

function searchBooks() {
    let searchInput = document.getElementById('searchInput').value.toLowerCase();
    let filteredBooks = books.filter(book => {
        return book.title.toLowerCase().includes(searchInput) || 
               book.author.toLowerCase().includes(searchInput) || 
               book.category.toLowerCase().includes(searchInput);
    });
    displayBooks(filteredBooks);
}

//función displayBooks
function displayBooks(booksList) {
    let booksTable = document.createElement('table');
    booksTable.innerHTML = `
        <tr>
            <th>Título</th>
            <th>Autor</th>
            <th>Categoría</th>
        </tr>
    `;

    booksList.forEach(book => {
        let row = booksTable.insertRow();
        row.innerHTML = `
            <td>${book.title}</td>
            <td>${book.author}</td>
            <td>${book.category}</td>
        `;
    });

    let booksDiv = document.getElementById('books');
    booksDiv.innerHTML = '';
    booksDiv.appendChild(booksTable);
}

searchBooks();