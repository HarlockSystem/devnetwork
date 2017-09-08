<?php
$this->layout('layout', [
    'title' => 'Homepage',
    'path' => $path,
    'session' => $session
])
?>

<?php echo __DIR__ ?>

<main class="wrapper aligner profil">
    <img class="imageProfil" src="../src/public/images/fakeprofil.jpg" alt="photo de profil">
    <h1>Linkharkat</h1>
    <!-- <h2>Dejour Adam</h2> <-->
    <div class="encadrement">
        <div class="cadre mainSkill">
            <h2>Skill</h2>
            <div class="skill">
                <img src="../src/public/images/skill/html5.svg" alt="html5">
                <img src="../src/public/images/skill/css3.svg" alt="css3">
                <img src="../src/public/images/skill/less.svg" alt="less">
                <img src="../src/public/images/skill/js.svg" alt="javascript">
                <img src="../src/public/images/skill/vue.svg" alt="vue">
                <img src="../src/public/images/skill/php.svg" alt="php">
                <img src="../src/src/public/images/skill/mysql.svg" alt="mysql">
            </div>
        </div>
        <div class="cadre mainEntreprise">
            <h2>Entreprise</h2>
            <table class="entreprise">
                <tr>
                    <td>Airbus</td>
                    <td>Back-End</td>
                </tr>
                <tr>
                    <td>Dior</td>
                    <td>Back-End</td>
                </tr>
                <tr>
                    <td>Cartier</td>
                    <td>Front-End</td>
                </tr>
                <tr>
                    <td>Tesla</td>
                    <td>Front-End</td>
                </tr>
                <tr>
                    <td>Victorinox</td>
                    <td>UX/UI</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="biographie">
        <h3>Biographie</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellat cumque exercitationem nam veniam provident earum odit non aperiam assumenda temporibus eaque fugiat, modi ipsam, fugit, aliquid? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi, rerum! Blanditiis cupiditate libero doloribus et maxime, fugit in saepe? Nam ad ex numquam amet esse tenetur quo cupiditate eius vel!
        </p>
    </div>
    <a href="" class="mail"><h2>julie.delacours@gmail.com</h2></a>
</main>