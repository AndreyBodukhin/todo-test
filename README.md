## Суть задания:

Тестовое задание, результат необходимо выложить в git репозиторий и написать инструкцию по деплою.

Для реализации использовать на бекенде PHP, фреймворк - Laravel, на фронте JS / jQuery. Для элементов интерфейса - Bootstrap

Реализовать ToDo список.

Необходимый функционал:

1) Хранение списков в БД. Сохранение сделать без перезагрузки страницы (ajax)

2) Регистрация / авторизация пользователей для создания личных списков. Возможность редактирования сохраненных списков

3) Возможность прикрепить к пункту списка изображение. Для изображения должно автоматически создаваться квадратное превью размером 150x150px. При нажатие на превью - в новой вкладке открывается исходное изображение. Изображение можно заменить / удалить

4) Возможность тегировать пункты списка. Кол-во тегов может быть не ограниченым. Теги формируются самим пользователем, т.е. набор произвольный, не фиксированный.

5) Поиск по элементам списка. Фильтрация элементов списка по тегам (одному или нескольким)

Дополнительный функционал (реализация - по желанию)

1) Возможность расшарить список другому пользователю (т.е. пользователь А может дать доступ на чтение пользователю Б)

2) Разграничение прав доступа к списку (пользователь А может только читать, пользователь Б может читать и редактировать)


Отдельный плюс, если получится самостоятельно развернуть проект и предоставить на него ссылку

## Перый запуск проекта:

```bash
docker-compose up -d
docker-compose exec laravel.test php artisan migrate:fresh --seed
docker-compose exec -d laravel.test php artisan queue:work
docker-compose exec laravel.test npm run build
docker-compose exec -d laravel.test npm run dev
```

## Запуск проекта:

```bash
docker-compose up -d
docker-compose exec -d laravel.test php artisan queue:work
docker-compose exec -d laravel.test npm run dev
```

# P.S:

Данное приложение легко укладывается в CRUD и всю логику можно было бы поместить в контроллеры.
Но при разработке данного проекта, я старался показать понимание архитектурных приемов, поэтому сделал контроллер тонким используя подход **CQRS**.

Но так же я следовал принципу **YAGNI** - поэтому не стал допускать оверхед и пытаться убрать все внешнии зависимости из хендлеров

В обработчиках команд можно было бы избежать дополнительных внешних зависимостей от фреймворка.
_Принцип DIP (Dependency Inversion Principle ) в SOLI**D**_

Для этого нужно ввести дополнительные интерфейсы.


Разберу на примере UploadImageCommandHandler

```php
final class UploadImageCommandHandler
{
    public function handle(UploadImage $command): void
    {
        $imageName = Str::uuid() . '.' . $command->image->extension();
        $command->image->storeAs('images', $imageName);
        $command->item->image = $imageName;
        $command->item->save();
        event(new ImageUploaded(storage_path('app/images') . "/$imageName"));
    }
}
```

Здесть есть зависимости от **Illuminate\Http\UploadedFile**, **Illuminate\Support\Str**, **Illuminate\Database\Eloquent\Model**, **event()**

Добавляем интерфейсы **EntityManager**, **HashGeneratorInterface**, **ImageUploaderInterface**, **EventDispatcher**,
для того что бы убрать эти зависимости.

Реализация могла бы выглядеть так:
```php
final class UploadImageCommandHandler
{
    public function __construct(
        readonly EntityManager          $em,
        readonly HashGeneratorInterface $hasher,
        readonly ImageUploaderInterface $uploader,
        readonly EventDispatcher        $dispatcher
    )
    {
    }

    public function handle(UploadImage $command): void
    {
        $imagePath = $this->uploader->upload($command->image);
        $command->item->setImage($imagePath);
        $this->em->save($command->item);
        $this->dispatcher->event(new ImageUploaded($imagePath));
    }
}

```
