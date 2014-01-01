## Example Laravel4 REST backend

Little example application to test and learn about Laravel4 PHP framework. Including testing, routing, filters, db migration and seed.

## Develop

    Waking up the app:

        git clone
        php artisan migrate
        php artisan db:seed
        php artisan serve

    Testing up if it's working:
    - List tasks

            ``curl -i --user test\@example.com:test localhost:8000/api/v1/task``

    - Create a task

            ``curl -i -X POST -F 'title=Testing' --user test\@example.com:test localhost:8000/api/v1/task``

    - Removing a task

            ``curl -i -X DELETE --user test\@example.com:test localhost:8000/api/v1/task``

## Testing

        ``phpunit`` should do the trick. Testing is configured to use and in-memory SQLi db.

## Feedback

If you'd like to contribute to the project or file a bug or feature request, please visit [the project page][1].

## License

The project is licensed under the [GNU GPL v3][2] ([tldr][3]) license. Which means you're allowed to copy, edit, change, hack, use all or any part of this project *as long* as all of the changes and contributions remains under the same terms and conditions.

  [1]: https://github.com/desyncr/laravel4rest/
  [2]: http://www.gnu.org/licenses/gpl.html
  [3]: http://www.tldrlegal.com/license/gnu-general-public-license-v3-(gpl-3)
