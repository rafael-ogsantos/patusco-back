## Sobre o projeto

Este projeto foi desenvolvido com laravel 10 e vue 3. E tem como objetivo criar um sistema de agendamento de consultas médicas para animais.

## Como executar o projeto

### Docker
    
    docker-compose up -d

### Laravel

    composer install
    php artisan key:generate
    php artisan migrate
    php artisan db:seed
    
## Utilização

Voce terá acesso a uma tela de login, onde poderá se autenticar com as seguintes credenciais:

    role: doctor
    email: doctor@example.com
    senha: 12345678

    role: receptionist
    email: receptionist@example.com
    senha: 12345678

## Observações

O projeto foi desenvolvido com o intuito de demonstrar meu conhecimento em relação ao framework laravel e ao framework vue. O projeto não está completo, faltando algumas funcionalidades como a de cancelar uma consulta, editar uma consulta, entre outras. O projeto foi desenvolvido em 3 dias, e o tive tempo hábil para finalizar todas as funcionalidades.

Mas uma das funcionalidades que gostaria de destacar é a de notificação de email por meio de schedule, onde o sistema envia um email para o dono do animal, 1 hora antes da consulta.
