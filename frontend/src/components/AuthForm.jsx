import { useState } from "react"
import api from "../services/api"
import { useNavigate } from "react-router-dom"

export default function AuthForm({buttonName, action})
{
    const [email, setEmail] = useState('')
    const [password, setPassword] = useState('')
    const navigate = useNavigate();

    async function handleLogin(e)
    {
        e.preventDefault()

        let body = {
            email,
            password
        }

        try {
            const response = await api.post(action, body)

            if (response.data.access_token) {
                localStorage.setItem('token', response.data.access_token);

                navigate('/dashboard')
            }
        } catch (err) {
            console.log('cheguei no erro')
            alert('Falha no login, tente novamente.')
        }
    }

    return (
        <>
            <form 
                onSubmit={handleLogin} 
                className="flex flex-col justify-center items-center p-4 border rounded-md border-solid border-slate-400"
            >
                <label>Email</label>
                <input 
                    className="mb-2 border rounded-md border-solid border-slate-400"
                    type="email" 
                    value={email}
                    onChange={e => setEmail(e.target.value)}
                />

                <label>Senha</label>
                <input 
                    className="mb-2 border rounded-md border-solid border-slate-400"
                    type="password" 
                    value={password}
                    onChange={e => setPassword(e.target.value)}
                />

                <button className="button bg-slate-400	" type="submit">{buttonName}</button>
            </form>
        </>
    )
}