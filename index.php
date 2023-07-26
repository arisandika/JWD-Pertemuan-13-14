<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="index.css">
  <title>Home</title>
  <style>
    body {
      background-color: #FAFBFD;
    }
  </style>
</head>

<body>
  <div class="navbar">
    <nav class="fixed top-0 z-30 w-full border-b bg-purple-600 border-gray-200">
      <div class="py-3 text-white">
        <div class="flex items-center justify-center">
          <span class="self-center font-bold sm:text-xl">Data Siswa SMAN 15 Tangerang</span>
        </div>
      </div>
    </nav>
  </div>

  <!-- Field -->
  <div class="field h-screen mt-10">
    <div class="p-4" id="main-content">
      <!-- Content -->
      <?php
      $p_dir = 'pages';
      if (!empty($_GET['p'])) {
        $pages = scandir($p_dir, 0);
        unset($pages[0], $pages[1]);
        $view = $_GET['p'];

        if (in_array($view . '.php', $pages)) {
          include $p_dir . '/' . $view . '.php';
        } else {
          echo '<h1>Page Not Found</h1>';
        }
      } else {
        include $p_dir . '/anggota.php';
      }
      ?>
    </div>
  </div>


  <script>
    function handleLinkClick(event) {
      event.preventDefault();

      resetLinkBackground();

      var links = event.currentTarget.parentElement.getElementsByTagName('a');
      for (var i = 0; i < links.length; i++) {
        links[i].classList.remove('active-link');
        links[i].style.backgroundColor = "";
      }

      event.currentTarget.classList.add('active-link');
      event.currentTarget.style.backgroundColor = "#6c2bd9";
      event.currentTarget.style.color = "#fff";

      loadContent(event.currentTarget.getAttribute('data-page'));
    }

    function resetLinkBackground() {
      var links = document.querySelectorAll('.sidebar-item a');
      for (var i = 0; i < links.length; i++) {
        links[i].classList.remove('active-link');
        links[i].style.backgroundColor = '';
        links[i].style.color = '';
      }
    }

    var links = document.querySelectorAll('.sidebar-item a');

    for (var i = 0; i < links.length; i++) {
      links[i].addEventListener('click', handleLinkClick);
    }

    function loadContent(page) {
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("main-content").innerHTML = this.responseText;
        }
      };
      xhttp.open("GET", "pages/" + page + ".php", true);
      xhttp.send();
    }

  </script>







  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
</body>

</html>