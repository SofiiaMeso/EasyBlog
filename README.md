### EasyBlog
Почти блог, точнее почти CMS для ведения блогов.   
Имеет только базовый функционал и ничего больше:
+ Добавление записей
+ Удаление записей
+ Изменение записей
+ Загрузка файлов выбранных форматов
+ Возможность подключения формы комментирования


### Структура таблицы "post" в Базе Данных  
| Name  | Type   | Unique           | Index            |AUTO_INCREMENT    |
|:-----:|:------:|:----------------:|:----------------:|:----------------:|
| id    | int    |:heavy_check_mark:|:heavy_check_mark:|:heavy_check_mark:|
| title | text   |                  |                  |                  |
| date  | date   |                  |                  |                  |
| text  | text   |                  |                  |                  |

### Описание файлов и директорий
:file_folder: files :heavy_minus_sign: *Директория для загрузки файлов*  
:file_folder: admin :heavy_minus_sign: *Директория Админ-панели*  
├:page_facing_up: exit.php :heavy_minus_sign: *Страница выхода*  
├:page_facing_up: index.php :heavy_minus_sign: *Страница со списком записей и формой добавления записи*  
├:page_facing_up: login.php :heavy_minus_sign: *Страница входа*  
├:page_facing_up: post.php :heavy_minus_sign: *Страница редактирования и удаления записи*  
└:page_facing_up: upload.php :heavy_minus_sign: *Загрузчик файлов*  
:page_facing_up: README.md :heavy_minus_sign: *Текущий файл информации*  
:page_facing_up: comments.php :heavy_minus_sign: *Файл с формой комментариев*  
:page_facing_up: config.php :heavy_minus_sign: *Файл настроек*  
:page_facing_up: font.otf :heavy_minus_sign: *Шрифт для заголовка*  
:page_facing_up: index.php :heavy_minus_sign: *Страница со всеми записями*  
:page_facing_up: post.php :heavy_minus_sign: *Страница отдельной записи*  
:page_facing_up: reset.css :heavy_minus_sign: *Файл обнуления стилей*  
:page_facing_up: style.css :heavy_minus_sign: *Файл стилей*  

### Описание файла настроек - "config.php"
##### Настройки блога
+ **$blog** :heavy_minus_sign: *Название блога*
+ **$url** :heavy_minus_sign: *URL-Адрес блога*
+ **$login** :heavy_minus_sign: *Логин администратора*
+ **$passwd** :heavy_minus_sign: *Пароль администратора* 

##### Настройки подключения к БД
+ **$host** :heavy_minus_sign: *Сервер БД*
+ **$user** :heavy_minus_sign: *Имя пользователя БД*
+ **$pass** :heavy_minus_sign: *Пароль пользователя БД*
+ **$db** :heavy_minus_sign: *Название БД*

##### Настройки загружаемых форматов  
+ **$whitelist** :heavy_minus_sign: *Доступные для загрузки форматы файлов*

### Безопасность
Вопроса хранения паролей на примере "config.php" был поднят анонимом на известном имиджборде.  
Архив доступен на [Arhivach.org](http://arhivach.org/thread/139785/).

### Тестирование
Мой [блог](http://blog.fedyukin.xyz) работает на "EasyBlog", там же система и тестируется.