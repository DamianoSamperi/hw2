<?php $__env->startSection('title','| Registrazione Ricetta UNICT'); ?>
<?php $__env->startSection('script'); ?>
 <script type="text/javascript" src="<?php echo e(asset('js\signup.js')); ?>" defer></script>
<?php $__env->stopSection(); ?>
 <link rel='stylesheet' href="<?php echo e(asset('css/Signup.css')); ?>">
<?php $__env->startSection('content'); ?>
<header>
  <h1  id="titolo">
    <em>REGISTRAZIONE</em><br/>
  </h1>
</header>
<body>
    <section class="nuova_vista">
        <main>
          <form method='post' action='/register'>Registrati
            <?php echo csrf_field(); ?> 
            <div><br></div>
            <div class='username'><label>Username <input type='text' name='username' ></label><span class='errorj'><br></span></div>
            <div class='password'><label>Password <input type='password' name='password' ></label><span class='errorj'><br></span></div>
            <div class='cellulare'><label>Cellulare <input type='text' name='cellulare' ></label><span class='errorj'><br></span></div>
            <div class='email'><label>E-mail <input type='text' name='email' ></label><span class='errorj'><br></span></div>
            <input type='submit' id="submit" value="Invia" disabled>
            <div class="Login">Hai un account? <a href="\">Accedi</a>
          </form>
        </main>
    </section>
</body>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.guest', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravelmongodb\resources\views/register.blade.php ENDPATH**/ ?>