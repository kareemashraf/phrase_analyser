<?php
// src/Controller/LuckyController.php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\HttpFoundation\JsonResponse;


class IndexController extends AbstractController {

    /**
     * @Route("/")
     */
    public function index(Request $request) {
        //first create the form
        $defaultData = ['message' => 'Enter a phrase'];
        $form = $this->createFormBuilder($defaultData)->add('text', TextType::class, ['constraints' => [new NotBlank(), new Length(['min' => 2, 'max' => 255]), ], 'label' => false, 'attr' => ['class' => 'form-control', 'id' => 'inlineFormInput'], ])->add('submit', SubmitType::class, ['attr' => ['class' => 'btn btn-primary'], ])->getForm();
       
        // validate the form on submit
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // collect the submited text
            $data = $form->getData();
            $text = $data['text'];
            $results = self::post_string($text);
        } else {
            $results = NULL;
        }

        return $this->render('base.html.twig', array('form' => $form->createView(), 'results' => $results,));
    }
    

    /**
     * this function is to create all the logic of the analysis
     */
    public function post_string($text) {
        $letter = [];
        $var = [];
        $text = str_replace(" ", "", $text);
        $arr = str_split($text); //create an array out of the phrase characters
        $tmp = array_count_values($arr); // Counts all the values of an array
        
        foreach ($arr as $key => $value) {
            $k = array_keys($arr, $value);
            $var[$value] = $k;
        }
        
        foreach ($tmp as $k => $value) {
            foreach ($var[$k] as $v) {
                $before[$k][] = (isset($arr[$v - 1])) ? $arr[$v - 1] : "none";
                $after[$k][] = (isset($arr[$v + 1])) ? $arr[$v + 1] : "none";
            }
        
            $distance = max($var[$k]) - min($var[$k]);
            // create one array that contains all the data to be parsed into the datatable
            $letter[$k]['letter'] = $k;
            $letter[$k]['before'] = $before[$k];
            $letter[$k]['after'] = $after[$k];
            $letter[$k]['count'] = $value;
            $letter[$k]['distance'] = ($distance > 0) ? 'max-distance: ' . $distance . ' chars' : '';
        }
        return $letter;
    }
}
