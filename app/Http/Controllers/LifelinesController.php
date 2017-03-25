<?php

namespace App\Http\Controllers;

use App\Lifeline;
use App\Network;
use Illuminate\Http\Request;

/**
 * Class LifelinesController
 *
 * @package App\Http\Controllers
 */
class LifelinesController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $collection = $this->getLifeLineCollection($request);

        $lifelines = $collection->keyBy('id');

        return response()->json($lifelines);
    }


    /**
     * @author Sam Ciaramilaro <sam.ciaramilaro@tattoodo.com>
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function help(Request $request)
    {
        $collection = $this->getLifeLineCollection($request);

        $lifelines = $collection
            ->unique('user')
            ->map(function($lifeline) {
            return $lifeline->user->name;
        });

        if ($lifelines->count() > 1) {
            $last = $lifelines->pop();
            if ($lifelines->count() > 1) {
                $lifelines->push('and ' . $last);
            } else {
                $lifelines->push($lifelines->pop() . ' and ' . $last);
            }
        }

        $lifelines = $lifelines->implode(', ');

        return response()->json($lifelines);
    }


    /**
     * @param Lifeline $lifeline
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Lifeline $lifeline)
    {
        return response()->json($lifeline->load('user'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $lifeline = Lifeline::create([
                'user_id'    => $request->get('userId'),
                'name'       => strtolower($request->get('name')),
                'network_id' => Network::first()->id,
            ]);
        } catch (\Exception $e)
        {
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return response()->json(['data' => $lifeline->toArray()], 201);
    }

    /**
     * @author Sam Ciaramilaro <sam.ciaramilaro@tattoodo.com>
     *
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    private function getLifeLineCollection(Request $request)
    {
        $query = Lifeline::with('user');

        if ($name = $request->get('name')) {
            $query->whereName($name);
        }

        return $query->orderBy('id', 'DESC')->get();
    }
}
