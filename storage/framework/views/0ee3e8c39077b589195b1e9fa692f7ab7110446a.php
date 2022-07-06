
<?php $__env->startSection('title','| Ricetta UNICT'); ?>
<?php $__env->startSection('script'); ?>
<script type="text/javascript" src="<?php echo e(asset('js/logged.js')); ?>" defer></script>
<?php $__env->stopSection(); ?>
    <link rel='stylesheet' href="<?php echo e(asset('css/hmw.css')); ?>">
<?php $__env->startSection('content'); ?>
<body>
  <header>
    <nav>
      <div id="menu">
        <div></div>
        <div></div>
        <div></div>
      </div>
      <div class="links" id="link">
        <div><span class="Logout"><a class='button' href="/logout">Logout</a></span>
         <button class="Hidden" id="Ritorna">Torna alla Home</button>
         <a class="button" id="Ricerca">Cerca</a>
        </div>
        <form class="Hidden" method='get' id="Ricerca">
        <!-- <?php echo csrf_field(); ?>  -->
          <input name='input' type="text" id="ricetta" placeholder='Inserisci richiesta'>
          <select name="scelta" id="scelta">
            <option value="rc" selected>Ricetta</option>
            <option value="us" >Utente</option>
          </select>
          <input type="submit" id="submit" value="Cerca">
        </form>
      </div>
    </nav>

    <h1  id="titolo">
      <?php 
      echo "<em>Benvenuto </em>" ;
      echo "<em id='session'>$user</em>"
      ?>
    </h1>

  </header>
    <section class="Descrizione">
      <span></span>
      <?php
      echo "<form method='post'  id='Crea_descrizione' class='Hidden' action='/SalvaDescrizione'>" ;
      ?>
      <?php echo csrf_field(); ?>
      <?php
      echo  "<div><textarea name=descrizione rows='5' cols='70' maxlength='50' id=descrizione placeholder='Inserisci una tua descrizione' value={{ csrf_token() }} ></textarea></div><br>
             <div> <input type='submit' name='invia' value='invia' /></div>
             </form>";       
      ?>
    </section>
    <main class='left'>
     <main>
      <section class="mostra_preferiti">
      </section>
      <section class="mostra_creati">
      </section>
     </main>
     <main class='interno'>
      <section class="nuova_vista">
      </section>
      <section class="creati" >
       <form method="post"  enctype="multipart/form-data"  id="Crea_ricetta" class='Hidden' action='/logged'>
         <?php echo csrf_field(); ?> 
         <div><input name='titolo' type="text" id="Titolo_creazione" placeholder='Inserisci titolo'></div><br>
         <div><textarea name="preparazione" rows="8" cols="50" id="preparazione" maxlength="50" placeholder='Inserisci preparazione'></textarea></div><br>
         <div>Scegli immagine <input name="img" type="file" id="img" accept='.jpg, .jpeg, image/png'/></div><br>
         <div> <input type="submit" name="carica" value="carica" /></div>
       </form>
       <section id='inserimento'></section>
      </section>
      <section class="Spotify"></section>
     </main>
    </main>
  </body>
  <footer >
     <div class="prova">Puoì mostrare le tue ricette preferite premendo sull'icone stella, <br> mostrare le ricette da te create o in caso crearne una premendo sull'icona del post</div>
     <div class='footer'>Svillupato da Damiano Samperi 1000003371</div>  
    </footer>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.guest', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravelmongodb\resources\views/home.blade.php ENDPATH**/ ?>