<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $products = [
        [
            'id' => 1,
            'title' => 'To Kill a Mockingbird',
            'author' => 'Harper Lee',
            'price' => 12.99,
            'genre' => 'Classic Literature',
            'isbn' => '978-0446310789',
            'published_year' => 1960,
            'description' => 'A novel about racial injustice in the American South',
            'stock' => 50,
            'image' => 'https://covers.openlibrary.org/b/isbn/9780446310789-L.jpg'
        ],
        [
            'id' => 2, 
            'title' => '1984',
            'author' => 'George Orwell',
            'price' => 10.99,
            'genre' => 'Dystopian Fiction',
            'isbn' => '978-0451524935',
            'published_year' => 1949,
            'description' => 'A dystopian novel set in a totalitarian society',
            'stock' => 45,
            'image' => 'https://covers.openlibrary.org/b/isbn/9780451524935-L.jpg'
        ],
        [
            'id' => 3,
            'title' => 'The Great Gatsby',
            'author' => 'F. Scott Fitzgerald',
            'price' => 11.99,
            'genre' => 'Classic Literature',
            'isbn' => '978-0743273565',
            'published_year' => 1925,
            'description' => 'A story of decadence and excess in the Jazz Age',
            'stock' => 30,
            'image' => 'https://covers.openlibrary.org/b/isbn/9780743273565-L.jpg'
        ],
        [
            'id' => 4,
            'title' => 'Pride and Prejudice',
            'author' => 'Jane Austen',
            'price' => 9.99,
            'genre' => 'Romance',
            'isbn' => '978-0141439518',
            'published_year' => 1813,
            'description' => 'A romantic novel of manners in Georgian England',
            'stock' => 40,
            'image' => 'https://covers.openlibrary.org/b/isbn/9780141439518-L.jpg'
        ],
        [
            'id' => 5,
            'title' => 'The Hobbit',
            'author' => 'J.R.R. Tolkien',
            'price' => 14.99,
            'genre' => 'Fantasy',
            'isbn' => '978-0547928227',
            'published_year' => 1937,
            'description' => 'A fantasy novel about the adventures of Bilbo Baggins',
            'stock' => 60,
            'image' => 'https://covers.openlibrary.org/b/isbn/9780547928227-L.jpg'
        ],
        [
            'id' => 6,
            'title' => 'Wuthering Heights',
            'author' => 'Emily Bronte',
            'price' => 11.99,
            'genre' => 'Classic Literature',
            'isbn' => '978-0141439556',
            'published_year' => 1847,
            'description' => 'A tale of passionate love and violent revenge on the Yorkshire moors',
            'stock' => 35,
            'image' => 'https://covers.openlibrary.org/b/isbn/9780141439556-L.jpg'
        ],
        [
            'id' => 7,
            'title' => 'Brave New World',
            'author' => 'Aldous Huxley',
            'price' => 13.99,
            'genre' => 'Dystopian Fiction',
            'isbn' => '978-0060850524',
            'published_year' => 1932,
            'description' => 'A dystopian novel about a genetically engineered future society',
            'stock' => 40,
            'image' => 'https://covers.openlibrary.org/b/isbn/9780060850524-L.jpg'
        ],
        [
            'id' => 8,
            'title' => 'Emma',
            'author' => 'Jane Austen',
            'price' => 10.99,
            'genre' => 'Romance',
            'isbn' => '978-0141439587',
            'published_year' => 1815,
            'description' => 'A novel about youthful hubris and romantic misunderstandings',
            'stock' => 25,
            'image' => 'https://covers.openlibrary.org/b/isbn/9780141439587-L.jpg'
        ],
        [
            'id' => 9,
            'title' => 'The Lord of the Rings',
            'author' => 'J.R.R. Tolkien',
            'price' => 24.99,
            'genre' => 'Fantasy',
            'isbn' => '978-0544003415',
            'published_year' => 1954,
            'description' => 'An epic high-fantasy novel about the quest to destroy a powerful ring',
            'stock' => 55,
            'image' => 'https://covers.openlibrary.org/b/isbn/9780544003415-L.jpg'
        ],
        [
            'id' => 10,
            'title' => 'Jane Eyre',
            'author' => 'Charlotte Bronte',
            'price' => 12.99,
            'genre' => 'Classic Literature',
            'isbn' => '978-0141441146',
            'published_year' => 1847,
            'description' => 'A novel following the emotions and experiences of its title character',
            'stock' => 45,
            'image' => 'https://covers.openlibrary.org/b/isbn/9780141441146-L.jpg'
        ]
    ];

    public function index()
    {
        $calculationDetails = collect($this->products)->map(function ($product) {
            return [
                'title' => $product['title'],
                'price' => $product['price'],
                'stock' => $product['stock'],
                'subtotal' => round($product['price'] * $product['stock'], 2)
            ];
        });

        $totalValue = $calculationDetails->sum('subtotal');

        return view('products.index', [
            'products' => collect($this->products)->sortBy('title'),
            'genres' => collect($this->products)->pluck('genre')->unique()->sort(),
            'totalBooks' => count($this->products),
            'totalValue' => round($totalValue, 2),
            'calculationDetails' => $calculationDetails
        ]);
    }

    public function show($id)
    {
        $product = collect($this->products)->firstWhere('id', (int)$id);
        
        if (!$product) {
            return redirect()->route('products.index')
                           ->with('error', 'Book not found');
        }

        return view('products.show', ['product' => $product]);
    }

    public function getByGenre($genre)
    {
        $products = collect($this->products)
            ->filter(function($product) use ($genre) {
                return $product['genre'] === $genre;
            })->values();

        return view('products.genre', [
            'products' => $products,
            'genre' => $genre
        ]);
    }
}
