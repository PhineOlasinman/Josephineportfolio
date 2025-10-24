<?php // information.php ?>
<!DOCTYPE html>
<html lang="en">
<head>
   <link rel="stylesheet" href="background.css">
</head>
<body>
  <div class="cv-container">
    <header>
      <h1>Information</h1>
      <nav>
        <ul>
          <!-- ✅ Corrected IDs -->
          <li><a id="objective-link">OBJECTIVE</a></li>
          <li><a id="demographic-link">DEMOGRAPHIC</a></li>
          <li><a id="education-link">EDUCATION</a></li>
          <li><a id="skills-link">SKILLS</a></li>
          <li><a id="reference-link">REFERENCE</a></li>
          <li><a href="../intro/index.php">HOME</a></li>
        </ul>
      </nav>
    </header>

    <div class="content">
      <div class="info-box" id="info-box">
        <div class="hello">Hello</div>
        <h2>I'm Josephine S. Olasiman</h2>
        <h3>IT Intern</h3>
        <p><span>PHONE:</span> +63 921 391 1736</p>
        <p><span>ADDRESS:</span> Bateria, Daanbantayan, Cebu</p>
        <p><span>E-MAIL:</span> josephinesabridoolasiman@email.com</p>
      </div>

      <div class="photo">
        <img src="ChatGPT Image Oct 6, 2025, 10_34_45 AM.png" alt="Profile Photo" />
        <div class="social-links">
          <a href="#" style="background-color:#3b5998;">f</a>
          <a href="#" style="background-color:#E1306C;">
            <img src="instagram-line.png" alt="Instagram Icon" width="20" height="20" />
          </a>
        </div>
      </div>
    </div>
  </div>

  <script>
    const infoBox = document.getElementById("info-box");

    function updateBoxFromFile(file) {
      infoBox.classList.add("fade");
      setTimeout(() => {
        fetch(file)
          .then(response => response.text())
          .then(data => {
            infoBox.innerHTML = data;
            infoBox.classList.remove("fade");
          });
      }, 300);
    }

    // ✅ Make sure IDs here match the ones above
    document.getElementById("objective-link").addEventListener("click", () => updateBoxFromFile('objective.php'));
    document.getElementById("demographic-link").addEventListener("click", () => updateBoxFromFile('demographic.php'));
    document.getElementById("education-link").addEventListener("click", () => updateBoxFromFile('education.php'));
    document.getElementById("skills-link").addEventListener("click", () => updateBoxFromFile('skills.php'));
    document.getElementById("reference-link").addEventListener("click", () => updateBoxFromFile('reference.php'));
  </script>
</body>
</html>
