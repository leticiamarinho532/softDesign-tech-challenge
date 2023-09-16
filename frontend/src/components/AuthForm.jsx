import { useState } from "react";

export default function AuthForm({buttonName, action})
{
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');

    async function handleLogin(e)
    {
        e.preventDefault()

        console.log('aqui')

        try {
            const response = await AudioParam.post(action);
        } catch {

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