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
