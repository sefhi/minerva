## 🚀 Instalación

### 🐳 Herramientas necesarias

1. [Instalar Docker](https://www.docker.com/get-started)
2. Clona este proyecto: `git clone https://github.com/sefhirot69/minerva.git`
3. __Opcional__: Instalar el comando `make` para mejorar el punto de entrada a nuestra aplicación.
    1. [Instalar en OSX](https://formulae.brew.sh/formula/make)
    2. [Instalar en Window](https://parzibyte.me/blog/2020/12/30/instalar-make-windows/#Descargar_make)

### 🔥 Ejecutar aplicación

1. Escribe por terminal el comando `make`. Este comando instalara todo lo necesario para arrancar la aplicación.
2. Tienes 3 urls disponibles:
    1. Api - http://localhost:9091
    2. Swagger API - http://localhost:8080
    3. Blog - http://localhost:3000

### 🌳 Estructura de la Api

#### Estructura DDD
```
.
├── Posts
│   ├── Application
│   │   ├── CreatorPostCommand.php
│   │   ├── CreatorPostCommandHandler.php
│   │   ├── FindAllPostQueryHandler.php
│   │   ├── PostAuthorResponse.php
│   │   ├── PostResponse.php
│   │   └── PostsResponse.php
│   ├── Domain
│   │   ├── Dto
│   │   │   └── PostCreatorDto.php
│   │   ├── Post.php
│   │   ├── PostAuthor.php
│   │   ├── PostContent.php
│   │   ├── PostId.php
│   │   ├── PostRepository.php
│   │   └── PostTitle.php
│   └── Infrastructure
│       └── FakerPostRepository.php
└── Shared
    └── Domain
        └── ValueObject
            ├── Author
            │   └── AuthorId.php
            ├── Email.php
            ├── Name.php
            ├── Primitive
            │   ├── IntValueObject.php
            │   └── StringValueObject.php
            ├── Username.php
            └── Website.php

```

#### Estructura Symfony

```
.
├── Controller
│   └── Posts
│       ├── PostsCreatorPostController.php
│       ├── PostsFindAllGetController.php
│       └── RequestCreatorPost.php
└── Kernel.php

```

#### Estructura Test

```
.
├── Controller
│   └── Posts
│       ├── PostsCreatorPostControllerTest.php
│       └── PostsFindAllGetControllerTest.php
├── Minerva
│   ├── Posts
│   │   ├── Application
│   │   │   ├── CreatorPostCommandHandlerTest.php
│   │   │   ├── CreatorPostCommandMother.php
│   │   │   ├── FindAllPostQueryHandlerTest.php
│   │   │   ├── PostAuthorResponseMother.php
│   │   │   ├── PostResponseMother.php
│   │   │   └── PostsResponseMother.php
│   │   ├── Domain
│   │   │   ├── Dto
│   │   │   │   └── PostCreatorDtoMother.php
│   │   │   ├── PostAuthorMother.php
│   │   │   ├── PostContentMother.php
│   │   │   ├── PostContentTest.php
│   │   │   ├── PostIdMother.php
│   │   │   ├── PostMother.php
│   │   │   ├── PostTitleMother.php
│   │   │   └── PostTitleTest.php
│   │   └── Infrastructure
│   │       └── FakerPostRepositoryTest.php
│   └── Shared
│       └── Domain
│           ├── MotherCreator.php
│           └── ValueObject
│               ├── Author
│               │   └── AuthorIdMother.php
│               ├── EmailMother.php
│               ├── EmailTest.php
│               ├── NameMother.php
│               ├── NameTest.php
│               ├── UsernameMother.php
│               ├── UsernameTest.php
│               ├── WebsiteMother.php
│               └── WebsiteTest.php
└── bootstrap.php

```