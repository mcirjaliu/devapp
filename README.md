
## Routes


<p align="center">http://localhost:8000/api/books</p>
<p align="center">http://localhost:8000/api/books?filter[author]=nume-autor</p>
<p align="center">http://localhost:8000/api/books?filter[title]=titlu</p>
<p align="center">http://localhost:8000/api/books?filter[published_at]=data-publicare</p>
<p align="center">http://localhost:8000/api/books/1 sau http://localhost:8000/api/books?filter[id]=1</p>

<p align="center">// sortare (colectie)</p>
<p align="center">http://localhost:8000/api/books?sort=camp</p>

<p align="center">// ordonare (query)</p>
<p align="center">http://localhost:8000/api/books?orderBy=camp,directie (asc,desc)</p>

<p align="center">// limitare</p>
<p align="center">http://localhost:8000/api/books?limit=N</p>
