Here's an updated code that will display the last 50 posts in a list style, sorted by the post modified date in descending order:
```
{% set args = {posts_per_page: 50, orderby: 'modified', order: 'DESC' } %}
{% set posts = mb.get_posts( args ) %}

<ul>
    {% for p in posts %}
        <li>
            <a href="{{ p.url }}">{{ p.post_title }}</a>
            <p>Modified on: {{ p.modified_date|date("F j, Y") }}</p>
        </li>
    {% endfor %}
</ul>
```
