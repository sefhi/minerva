[![CI-Atenea](https://github.com/sefhirot69/minerva/actions/workflows/atenea.yml/badge.svg)](https://github.com/sefhirot69/minerva/actions/workflows/atenea.yml)

--------------------------------------

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
├── Authors
│   ├── Domain
│   │   ├── Author.php
│   │   ├── AuthorFinder.php
│   │   └── AuthorRepository.php
│   └── Infrastructure
│       └── StubAuthorsRepository.php
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
│   │   ├── PostAuthorNotFoundException.php
│   │   ├── PostContent.php
│   │   ├── PostId.php
│   │   ├── PostRepository.php
│   │   └── PostTitle.php
│   └── Infrastructure
│       ├── FakerPostRepository.php
│       ├── GuzzleHttpClientException.php
│       ├── Stub
│       │   ├── posts.json
│       │   └── users.json
│       └── StubPostRepository.php
└── Shared
    └── Domain
        ├── Exceptions
        │   ├── AuthorNotFoundException.php
        │   └── HttpClientException.php
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

#### Explicación:

He decidido dividor en tres módulos/contextos separados.
- **Posts**
- **Authors**
- **Shared**

#### Posts

En este módulo es donde está todo el grueso de la aplicación. 
Contiene los casos de uso:
- Para crear un post.
- Para devolver todos los posts disponibles.

A nivel de dominio, he considerado incluir una parte
para los detalles del Author, como puede ser la clase
PostAuthor, ya que en el ejercicio se pedía que al devolver un Post
estuviera incluido los detalles del Author en el propio Post.

Esto ha sido un quebradero de cabeza, porque al implementar
la lógica con la API proporcionada, con una implementación Guzzle 
muy básica que había instalado, a nivel de rendimiento 
era muy ineficiente con este caso. Porque tenía una vez devueltos todos los Post, hacer un map
y devolver para cada Post los detalles de su Author. A nivel 
de performance en el front, podía tardar más de 3 segundos
en devolver los Post con los detalles del Author incluidos.

Así que al final, para poder trabajar más comodamente y luego pensar como
hacer la implementación con la API, me he instalado un FakerPhp (que suelo usar para hacer los ObjectMother)
y he estado **hardodeando** los resultados, intentando emular un resultado real.

Más adelante cuando ya tenia el grueso de la aplicación, he decidido hacer una implementación
con la API, pero esta vez me he descargado los ficheros json y he decidido trabajar contra esos ficheros
en vez de contra la API, obteniendo una mejora en rendimiento, mucho mejor que contra la API.

#### Authors

Este contexto, lo he creado muy al final. Cuando he visto que estaba repitiendo en algunos
lugares, el servicio que dado un authorId, me devuelve un Author. Por lo que he decidido crear este contexto
con el fin de crear un servicio de dominio con la clase **AuthorFinder** para que busque autores
dando un id y devuelva un excepción **AuthorNotFoundException** en caso de que no lo encuentre.

De manera, que si en futuro se decidiera crear un endpoint para devolver un author, 
solo tendría crear el controller y caso de uso para devolver e inyectarle el **AuthorFinder**.

No tiene mucha más lógica este contexto.

#### Shared

Este contexto, lo he creado, porque consideraba que el valueObject **AuthorId**, lo iba usar 
en diferentes contextos, y que ValueObjects como **Name**, **Email**, etc serían utilizados
si en un futuro se crearán otros módulos o contextos.

-----------------------------

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

### Explicación

No tiene mucho más. Una carpeta **Posts**, donde está todos los controllers/endpoint
relacionado con los Post. Yo por normal general suelo crear controller pequeños 
que hagan una sola cosa.

Me creado una clase RequestCreatorPost, para el request recibido para el endpoint que crea los post.
Esta clase es una especie de dto, para luego crear el command, para el caso de uso CreatorPostCommandHandler.
Esta clase, contiene unos atributos o constraint de symfony para validar que el request llega con los valores correctamente.

Decir que he intentado, deserializar el request con el serializador de Symfony. Pero he tenido problemas con symfony 6
y no me he parado mucho a mirar cual era el problema y que habían cambiado con respecto a serializadores posteriores. 
Por lo que el resquest lo he deserializado manualmente.


#### Estructura Test

```
.
├── Controller
│   └── Posts
│       ├── PostsCreatorPostControllerTest.php
│       └── PostsFindAllGetControllerTest.php
├── Minerva
│   ├── Authors
│   │   ├── Domain
│   │   │   ├── AuthorFinderTest.php
│   │   │   └── AuthorMother.php
│   │   └── Infrastructure
│   │       └── StubAuthorsRepositoryTest.php
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
│   │       ├── FakerPostRepositoryTest.php
│   │       └── StubPostRepositoryTest.php
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

#### Explicación

Está estructurado de la siguiente manera:

- Controller
- Minerva

En la carpeta controller he decidido hacer tests e2e, para que pasen por todo el flujo de la aplicación. 

En la carpeta Minerva, están todos los tests unitarios de la aplicación con el sufijo Test. 
Los que tiene el sufijo Mother, son ObjectMother, que voy usando a lo largo de los tests, para mayor comodidad.