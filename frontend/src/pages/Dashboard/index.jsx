import { useState, useEffect } from 'react';
import BookInfosAndActions from '../../components/BookInfosAndActions';
import api from "../../services/api"

export default function Dashboard() {
    const [books, setBooks] = useState([]);
    const token = localStorage.getItem('token');

    useEffect(() => {
        api.get('/books?pagination=10', {
            headers: {
                Authorization: `Bearer ${token}` 
            }
        })
        .then( response => {
            setBooks(response.data.data)
        })
    });

    return (
        <>
            <h3>Dashboard</h3>

            <ul>
                {
                    books.map(book => (
                        <BookInfosAndActions
                            key={book.id} 
                            book={[
                                book.title, 
                                book.author, 
                                book.page_numbers, 
                                book.created_at
                            ]}
                        />
                    ))
                }
            </ul>
        </>
    )
}