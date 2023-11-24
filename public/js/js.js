document.addEventListener("DOMContentLoaded", function () {
    // Cadastro
    var cadastroForm = document.getElementById("cadastro-form");
    if (cadastroForm) {
        cadastroForm.addEventListener("submit", function (e) {
            e.preventDefault();
            var formData = new FormData(this);

            fetch("controller/controllCadastrarAdmin.php", {
                method: "POST",
                body: formData,
            })
            .then(response => response.text())
            .then(data => {
                var resultElement = document.getElementById("result");
                if (resultElement) {
                    resultElement.innerHTML = data;
                }
            });
        });
    }

    // Login
    var loginForm = document.getElementById("login-form");
    if (loginForm) {
        loginForm.addEventListener("submit", function (e) {
            e.preventDefault();
            var formData = new FormData(this);

            fetch("controller/controlLogarAdmin.php", {
                method: "POST",
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Login bem-sucedido, redirecione para outra página
                    window.location.href = 'view/painel.php';
                } else {
                    // Exiba a mensagem de erro para o usuário
                    var resultElement = document.getElementById("result");
                    if (resultElement) {
                        resultElement.classList.add("error-message");
                        resultElement.textContent = data.message;
                    }
                }
            });
        });
    }

    const button = document.querySelector(".menu-toggle");
    const menu = document.querySelector(".menu");

    if (button && menu) {
        button.addEventListener("click", () => {
            menu.classList.toggle("active");
        });
    }

    var btnSignin = document.querySelector("#signin");
    var btnSignup = document.querySelector("#signup");
    var body = document.querySelector("body");

    if (btnSignin) {
        btnSignin.addEventListener("click", function () {
            body.className = "sign-in-js";
        });
    }

    if (btnSignup) {
        btnSignup.addEventListener("click", function () {
            body.className = "sign-up-js";
        });
    }
});



// Identificar todos os botões de abertura do modal
var openButtons = document.querySelectorAll(".openProfileModal");

// Função para abrir o modal
function openProfileModal() {
    document.getElementById("profileModal").style.display = "block";
}

// Adicionar um evento de clique a cada botão
openButtons.forEach(function (button) {
    button.addEventListener("click", openProfileModal);
});

// Função para fechar o modal
function closeProfileModal() {
    document.getElementById("profileModal").style.display = "none";
}

// Adicionar um evento de clique ao botão "X" no modal
// Adicionar um evento de clique ao botão "X" no modal
var closeButton = document.getElementById("closeModal");
if (closeButton) {
    closeButton.addEventListener("click", closeProfileModal);
}

// Fechar o modal se o usuário clicar fora dele
window.addEventListener("click", function (event) {
    var modal = document.getElementById("profileModal");
    if (event.target == modal) {
        modal.style.display = "none";
    }
});

document.addEventListener('DOMContentLoaded', function() {
  const searchInput = document.querySelector('.search-box input');
  const tableRows = document.querySelectorAll('tbody tr');

  searchInput.addEventListener('input', function() {
      const searchTerm = searchInput.value.toLowerCase();

      tableRows.forEach(function(row) {
          const rowData = row.textContent.toLowerCase();

          if (rowData.includes(searchTerm)) {
              row.style.display = '';
          } else {
              row.style.display = 'none';
          }
      });
  });
});

document.addEventListener('DOMContentLoaded', function() {
  const inputFile = document.getElementById('fileFoto');
  const imageFoto = document.getElementById('imageFoto');
  const fotoInput = document.getElementById('foto');

  inputFile.addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function() {
        imageFoto.src = reader.result;
        fotoInput.value = reader.result;
      };
      reader.readAsDataURL(file);
    }
  });
});


var modal = document.getElementById('id01');
 
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

// Função para criar ou atualizar um cookie
function setCookie(name, value, days) {
  let expires = "";
  if (days) {
      const date = new Date();
      date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
      expires = "; expires=" + date.toUTCString();
  }
  document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

// Função para ler um cookie
function getCookie(name) {
  const nameEQ = name + "=";
  const ca = document.cookie.split(';');
  for (let i = 0; i < ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) === ' ') {
          c = c.substring(1, c.length);
      }
      if (c.indexOf(nameEQ) === 0) {
          return c.substring(nameEQ.length, c.length);
      }
  }
  return null;
}


function setCookie(name, value) {
    const date = new Date();
    date.setTime(date.getTime() + (365 * 24 * 60 * 60 * 1000)); // Cookie válido por 1 ano
    const expires = "expires=" + date.toUTCString();
    document.cookie = name + "=" + value + ";" + expires + ";path=/";
}

function getCookie(name) {
    const decodedCookies = decodeURIComponent(document.cookie);
    const cookies = decodedCookies.split(';');
    for (const cookie of cookies) {
        const parts = cookie.split('=');
        if (parts[0].trim() === name) {
            return parts[1];
        }
    }
    return "";
}
 // Função para abrir o modal
 function openModal() {
    var modal = document.getElementById("myModal");
    modal.style.display = "block";
}

// Função para fechar o modal
function closeModal() {
    var modal = document.getElementById("myModal");
    modal.style.display = "none";
}

// Função para confirmar a saída e redirecionar para a página de login
function confirmExit() {

    window.location.href = 'https://hostdeprojetosdoifsp.gru.br/loveinmug/login.html';
}

// Função para fazer logout
function logout() {
    // Limpar o token de autenticação
    localStorage.removeItem('token');
    // Redirecionar o usuário para a página de login
    window.location.href = 'https://hostdeprojetosdoifsp.gru.br/loveinmug/login.html';
}



