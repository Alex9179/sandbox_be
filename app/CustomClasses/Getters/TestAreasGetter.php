<?php

namespace App\CustomClasses\Getters;

use Illuminate\Support\Facades\DB;
use App\Models\TestAreas;

class TestAreasGetter
{
    /**
     * Display the Areas as geoJSON
     *
     * @return \Illuminate\Http\Response
     */
    public static function polygons()
    {
      $geoJSONFeature = DB::select("SELECT
                                        json_build_object(
                                          'type', 'FeatureCollection',
                                          'features', json_agg(
                                            json_build_object(
                                              'type', 'Feature',
                                              'geometry', ST_AsGeoJSON(a.geom,4326)::json,
                                              'properties', json_build_object(
                                                  'area_code', a.area_code,
                                                  'area_name', a.area_name,
                                                  'value', floor(random() * 5) + 1
                                              )
                                            ) 
                                          ),
                                          'crs', json_build_object(
                                              'type', 'name',
                                              'properties', json_build_object(
                                                  'name', 'EPSG:4326'
                                              )
                                          )
                                        ) json
                                      FROM
                                        test_areas a");

        return $geoJSONFeature[0]->json;
    }

}