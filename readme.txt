
http://localhost:8000/api/books
http://localhost:8000/api/books?filter[author]=nume-autor
http://localhost:8000/api/books?filter[title]=titlu
http://localhost:8000/api/books?filter[published_at]=data-publicare
http://localhost:8000/api/books/1 sau http://localhost:8000/api/books?filter[id]=1

// sortare (colectie)
http://localhost:8000/api/books?sort=camp

// ordonare (query)
http://localhost:8000/api/books?orderBy=camp,directie (asc,desc)

// limitare
http://localhost:8000/api/books?limit=N