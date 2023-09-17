export default function BookInfosAndActions(
    key,
    book={title, author, pageNumbers, creationDate}
)
{
    return (
        <>
            <li key={key} className="border border-slate-400">
                {book.title} -
                {book.author} -
                {book.pageNumbers} -
                {book.creationDate}
            </li>
        </>
    )
}