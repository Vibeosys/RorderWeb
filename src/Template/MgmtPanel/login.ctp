<?php
    use Cake\Cache\Cache;
    use Cake\Core\Configure;
    use Cake\Datasource\ConnectionManager;
    use Cake\Error\Debugger;
    use Cake\Network\Exception\NotFoundException;
    use App\Controller;

     $this->layout = 'rorder_login_layout';
     
     //$this->start('content');
?>
        <div class="site__container">
            <div class="grid__container">
                <div class="site-logo">
                    <div class="site-logo-img">
                       <?= $this->Html->image('quickserve-logo.PNG', ['class' => 'quickserve-img','alt' => 'QuickServe'])?>
                    </div>
                </div>
                <form action="login" method="post" class="form form--login">
                    <div class="form__field">
                        <label class="fontawesome-user" for="login__username"><span class="hidden">Username</span></label>
                        <input id="login__username" type="text" name="userName" class="form__input" placeholder="Username" required>
                    </div>
                    <div class="form__field">
                        <label class="fontawesome-lock" for="login__password"><span class="hidden">Password</span></label>
                        <input id="login__password" type="password" name="password" class="form__input" placeholder="Password" required>
                    </div>
        <?php if(isset($message)){?>
                   <div id="error-div" style="margin-left: 20%;color: <?= $color ?>" ><?=$message?></div>
        <?php }?>
                    <div class="form__field" style="margin-left:0px">
                        <input name="login" type="submit" value="Sign In">
                        <a href="forgotpassword">Forgot Password?</a>
                    </div>
                </form>
            </div>
        </div>
