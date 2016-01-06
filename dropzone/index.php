<!DOCTYPE html>
<html>
  <header>
    <title>Dropzone</title>
    <!-- Dropzone -->
    <link rel="stylesheet" type="text/css" href="dropzone/css/dropzone.css">
    <script src="dropzone/dropzone.js"></script>
  </header>
  <body style="margin-left:50px;margin-top:50px;">
    <h1>Multiple Uploads with Drag and Drop</h1>
    <form action="api.php" class="dropzone">
      <div class="fallback">
        <input name="file" type="file" multiple />
      </div>
    </form>
  </body>
</html>
