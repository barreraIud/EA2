<?php

namespace App\Http\Controllers;

// Este controlador hace uso de los dos modelos involucrados en una orden:
// el 'Customer' que solicita uno o varios 'Product'
use App\Models\Product;
use App\Models\Customer;

//Se usó la clase Log para verificar el estado de distintas variables:
//use Illuminate\Support\Facades\Log;

// Se usa la clase OrderApiRequest para manipular la petición, esta es una extensión del modelo 
// Request creado en la carpeta App\Http\Requests para definir los criterios personalizados de
// validación de los datos y el retorno de mensajes personalizados de error en caso de haberlos.
use App\Http\Requests\OrderApiRequest;
// !!!!!!!!!!!!!!!! IMPORTANTE !!!!!!!!!!!!!!!!!!!!!!
// Es necesario configurar una llave en el Header de Postman para lograr visualizar los mensajes
// de error en la interfaz de Postman. En el siguiente enlace presentan cómo configurar la llave
// https://learning.postman.com/docs/sending-requests/requests/#configuring-request-headers
// en el campo Key debe ir el valor X-Requested-With y en el campo Value el valor XMLHttpRequest.
// Para más información visitar la pregunta de MrRobot21 y la respuesta de NicoDevs en el foro: 
// https://laracasts.com/discuss/channels/laravel/how-to-send-validation-errors-as-json-to-view


class OrderApiController extends Controller
{
    public function __construct()
    {
    }

    //------------------------------------------ STORE -------------------------------------------------
    //Método para guardar una nueva orden en la BD desde una petición tipo Post desde una API REST
    public function store(OrderApiRequest $request){ //La petición recibida se define como objeto de 
                                                    // la clase OrderApiRequest por lo que es validada antes de
                                                    // realizar las acciones del método store, si hay algún
                                                    // error el método store no se ejecuta.

        // Si no hay errores en la petición recibida se inican los pasos de este método:

        // Primero se crea el comprador en la tabla customers. 
        // El método firstOrCreate guarda el registro si no existe antes,
        // si si existe no lo modifica:
        $customer = Customer::firstOrCreate(['email' => $request->input('email')]);
        
        // Luego se crea una variable con los productos pedidos en la orden:
        $products_ordered = $request->input('products');

        // Para cada producto pedido se ejecutan los siguientes pasos:
        foreach ($products_ordered as $product_ordered) {
            //Se definen variables con el id del producto y cantidad ordenada;
            $product_id = $product_ordered['id'];
            $quantity_ordered = $product_ordered['quantity'];

            //Se crea un objeto con los atributos del producto tomados de la BD
            $product = Product::find($product_id); 

            //Se definen variables con el precio y cantidad actual en inventario del producto
            $current_price = $product->price;
            $inventory = $product->inventory;

            //Si hay suficiente stock en el inventario se realiza el pedido:
            if ($inventory >= $quantity_ordered) {
                //El método attach registra la orden en la tabla intermedia products_customers
                //ingresando el id del customer, del product, la cantidad pedida y el precio actual
                $customer->products()->attach($product_id, [
                    'quantity' => $quantity_ordered,
                    'current_price' => $current_price
                ]);

                //Se reduce la cantidad del producto en inventario:
                $product->inventory = $inventory - $quantity_ordered;
                $product->save();
            } else 
            { //Si no hay suficiente stock en el inventario no se realiza el pedido y se retorna mensaje de error:
                return response()->json( 'There is not enough inventory to order '.$quantity_ordered.' products with id '.$product_id.', there are '.$inventory.' units in stock', 400);
            }        
        }

        //Si todo el método se ejecuta con éxito se retorna un mensaje de éxito
        return response()->json(['message' => 'Order successfully generated'], 201);

    }

    //---------Método para consultar las órdenes realizadas por customer a través de una petición tipo Get
    //---------desde una API REST
    public function getByEmail($email) {
        //Se crea un objeto con los atributos del customer con el email enviado en la petición
        //y tomados de la BD:
        $customer = Customer::where('email', $email)->first();
        
        //Si no existe dicho email en la BD y no se crea el objeto customer se retorna un mensaje de error:
        if (empty($customer)) {
            return response()->json(['message' => 'Not Found'], 404);
        }  

        //En caso contrario aplica el método productos para cargar en el customer los datos de todos los productos
        //que ha ordenado:
        $customer->products;          

        //Se devuelve el objeto en formato json:
        return response()->json($customer, 200);
    }

}
