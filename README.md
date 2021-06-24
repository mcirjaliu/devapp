
## Routes


<p align="left">http://localhost:8000/api/books</p>
<p align="left">http://localhost:8000/api/books?filter[author]=nume-autor</p>
<p align="left">http://localhost:8000/api/books?filter[title]=titlu</p>
<p align="left">http://localhost:8000/api/books?filter[published_at]=data-publicare</p>
<p align="left">http://localhost:8000/api/books/1 sau http://localhost:8000/api/books?filter[id]=1</p>

<p align="left">// sortare (colectie)</p>
<p align="left">http://localhost:8000/api/books?sort=camp</p>

<p align="left">// ordonare (query)</p>
<p align="left">http://localhost:8000/api/books?orderBy=camp,directie (asc,desc)</p>

<p align="left">// limitare</p>
<p align="left">http://localhost:8000/api/books?limit=N</p>
