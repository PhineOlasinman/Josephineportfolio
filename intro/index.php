<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Front Page</title>
  <link rel="stylesheet" href="front.css">
</head>
<body>
  <?php include 'header.php'; ?>

  <!-- HOME SECTION -->
  <section class="hero" id="home">
    <div class="content">
      <h1>WELCOME!</h1>
      <p>Read and know more about <br><strong>Josephine S. Olasiman</strong></p>
      <button id="infoBtn">Information</button>
    </div>
  </section>

  <!-- ABOUT SECTION -->
  <section id="about">
    <div class="content">
      <h2>About Me</h2>
      <p>
        Hello! I'm <strong>Josephine S. Olasiman</strong>, a passionate and creative individual who loves exploring
        design, technology, and innovation. My portfolio showcases projects that reflect my dedication to learning,
        growth, and excellence. I strive to create meaningful work that inspires others and contributes to positive change.
      </p>
      <p>
        Outside of work, I enjoy discovering new ideas, improving my skills, and collaborating with people who share
        the same passion for creativity and innovation. My goal is to continue growing and sharing my experiences through
        my work.
      </p>
    </div>
  </section>

  <?php include 'footer.php'; ?>

  <script>
    // Information button redirects directly
    document.getElementById('infoBtn').onclick = () => {
      window.location.href = 'info/background.php';
    };
  </script>
</body>
</html>
