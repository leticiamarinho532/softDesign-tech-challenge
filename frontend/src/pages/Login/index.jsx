import AuthForm from "../../components/AuthForm"

export default function Login() {
    return (
        <div className="w-screen h-screen flex flex-col justify-center items-center">
            <h3 className="text-2xl mb-8">Login</h3>

            <AuthForm
                buttonName={'Entrar'}
                action={'/login'}
            />
        </div>
    )
}