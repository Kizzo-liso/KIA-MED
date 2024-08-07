<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorias - KiaMed</title>
    <link rel="stylesheet" href="../public/css/home.css">
    <link rel="stylesheet" href="../../public/css/categoria.css">
    <link rel="stylesheet" href="../public/css/mododark.css">
    <link rel="stylesheet" href="../../public/css/header.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    </style>    
    </head>
<body>
    
<?php 
    include("header.php");
    ?>  

    <section class="container-apresentacao">
        
        <div class="container-frase-motivacional">

            <h2>Aquele que não tem tempo para cuidar da saúde vai ter que arrumar tempo para cuidar da doença.</h2>

            <p> - Lair Ribeiro, médico e escritor brasileiro.</p> 

        </div>

        <div class="container-imagem-apresentacao">

            <a href="https://br.freepik.com/vetores-gratis/fundo-do-dia-mundial-da-saude-mental-gradiente_30591586.htm#fromView=search&page=1&position=10&uuid=d848d34d-0f51-473c-a066-4b011bf3f631" target="_blank"><img class="imagem-apresentacao" src="../../public/img/Imagem de apresentação.jpg" alt="Imagem de Ilustração sobre Saúde Mental" height="300px" width="550px"></a>

        </div>

    </section>

    <section class="container">

        <div class="slider-wrapper">

            <div class="card-list">

                <div class="card-item">

                    <img class="user-image" src="../../public/img/Ansiedade.png" alt="Imagem ilustrando Ansiedade">

                    <h2 class="user-categoria">Ansiedade</h2>

                    <p class="user-descricao">A ansiedade é uma resposta natural do corpo ao estresse, caracterizada por sentimentos de preocupação,
                    nervosismo ou medo sobre eventos futuros ou situações incertas.</p>

                    <a href="Ansiedade.php"><button class="message-button">Veja Mais!</button></a>
                </div>
                
                <div class="card-item">

                    <img class="user-image" src="../../public/img/Depressão.png" alt="Imagem Ilustrando Depressão">

                    <h2 class="user-categoria">Depressão</h2>

                    <p class="user-descricao">Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet quasi molestias accusamus, dignissimos beatae eos esse iure nisi perspiciatis debitis facere, error vitae enim id inventore fugiat reprehenderit assumenda explicabo!</p>

                    <a href="Depressão.php"><button class="message-button">Veja Mais!</button></a>

                </div>

                <div class="card-item">

                    <img class="user-image" src="../../public/img/Bipolaridade.png" alt="Imagem Ilustrando AutoEstima">

                    <h2 class="user-categoria">Bipolaridade</h2>

                    <p class="user-descricao">Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet quasi molestias accusamus, dignissimos beatae eos esse iure nisi perspiciatis debitis facere, error vitae enim id inventore fugiat reprehenderit assumenda explicabo!</p>

                    <a href="Bipolaridade.php"><button class="message-button">Veja Mais!</button></a>

                </div>

                <div class="card-item">

                    <img class="user-image" src="../../public/img/Bordeline.png" alt="Imagem Ilustrando Bordeline">

                    <h2 class="user-categoria">Bordeline</h2>

                    <p class="user-descricao">Transtorno de Personalidade Borderline é o nome do transtorno de saúde mental dado a pessoas que possuam um padrão
                        de comportamento permeado pela impulsividade, instabilidade emocional, medo da rejeição e tendências autodepreciativas.</p>

                    <a href="Borderline.php"><button class="message-button">Veja Mais!</button></a>

                </div>

            </div>

        </div>

    </section>

</body>
</html>