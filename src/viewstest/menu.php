<?php ?>
<hr />
<a href="<?php echo $path->generateUrl('Homepage') ?>">Home</a> |
<a href="<?php echo $path->generateUrl('Users') ?>">Users</a> |
<a href="<?php echo $path->generateUrl('Posts') ?>">Posts</a> |

<?php //Add post IF logged
if ($session->isLogged()): ?>
<a href="<?php echo $path->generateUrl('PostNew') ?>">+ Post</a> |
<?php endif; ?>

<a href="<?php echo $path->generateUrl('Tags') ?>">Tags</a> |||

<?php //user is logged --> user account, logout
if ($session->isLogged()): ?>
<?php $usrData = $session->getUser() ?>
<a href="<?php echo $path->generateUrl('UserShow', ['id' => $usrData['id']]) ?>"><?= $this->e($usrData['name']) ?></a> |
<a href="<?php echo $path->generateUrl('UserLogout') ?>">Logout</a>
<?php //user id anonymous: --> sign in, login
else : ?>
<a href="<?php echo $path->generateUrl('UserNew') ?>">Sign In</a> |
<a href="<?php echo $path->generateUrl('UserLogin') ?>">Login</a>
<?php endif; ?>

<hr />





