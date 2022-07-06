
<?php $__env->startSection('title','| Ricetta UNICT'); ?>
<?php $__env->startSection('script'); ?>
<script type="text/javascript" src="<?php echo e(asset('js/login.js')); ?>" defer></script>
<script type="text/javascript" src="<?php echo e(asset('js/carica.js')); ?>" defer></script>
<?php $__env->stopSection(); ?>
    <link rel='stylesheet' href="<?php echo e(asset('css/login.css')); ?>">
<?php $__env->startSection('content'); ?>
<body>
    <header>
      <nav>
        <div id="links">
          <div>
           <?php
              if (old('username')||old('password')) {
                 echo "<span class='errorj'>Username e/o password errati.</span>";
              }     
            ?>
           <a class="button">Login</a>
           <form class="Hidden" method="post" action='/login'>
             <?php echo csrf_field(); ?>
             <input type="text" name="username" placeholder='username'>
             <input type="password" name="password" placeholder='Password'>
             <input type="submit" id="submit" value="Invia">
             <div class="Signup">Non hai un account? <a href="register/index">Iscriviti</a>
           </form>
          </div>
        </div>
      </nav>

      <h1  id="titolo">
        <em>Ricette Unict</em><br/>
      </h1>

    </header>
    <section class="nuova_vista">
    </section>
    <footer>
        <div> Damiano Samperi 1000003371</div>
    </footer>
  </body>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.guest', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravelmongodb\resources\views/login.blade.php ENDPATH**/ ?>