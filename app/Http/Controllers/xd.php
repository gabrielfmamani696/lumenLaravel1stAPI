namespace App\Http\Controllers;

use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function jwt(User $user){
        $payload = [
            // issue for token
            "iss"=>"api-youtube-jwt",
            // subject
            "sub"=>$user->id,
            // tiempo cuando fue creado el jwy
            "iat"=>time(),
            "exp"=>time() + 60*60
        ];
        return JWT::encode($payload, env('JWT_SECRET'), 'HS256');
    }
    // esto es una guarda en caso de que no exista el correo
    public function authenticate(User $user){

        // valida la request del objeto que invoca este metodo para ver si tiene el email y password 
        $this->validate($this->request, [
            'email'=>'required|email',
            'password'=> 'required'
        ]);

        // compara el email que viene de la bd con la de la request
        $user = User::where('email', $this->request->get->input('email'))->first(); 
        // el correo existe?
        if(!$user){
            return response()->json([
                'error'=>'El correo no existe'
            ], 400);
        }
        // si la pass que estoy pasando es igual a la que tengo en la bd
        if($this->request->input('password') == $user->password){
            return response()->json([
                'token' => $this->jwt($user)
            ], 200);
        }
        return response()->json([
            'error' => 'El correo o el password estan incorrectos'
        ], 400);
    }

}