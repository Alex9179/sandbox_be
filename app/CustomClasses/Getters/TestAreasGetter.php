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
                                              'geometry', ST_AsGeoJSON(ST_Transform( a.geom, 4326 ),6)::json,
                                              'properties', json_build_object(
                                                  'area_code', a.area_code,
                                                  'area_name', a.area_name,
                                                  'value', dat.quintile
                                              )
                                            ) 
                                          )) json
                                      FROM
                                        BRIGHTSON_MSOA_BUILDINGS A
                                        INNER JOIN BRIGHTON_MSOA_POP DAT
                                        ON A.AREA_CODE = DAT.AREA_CODE");

        return $geoJSONFeature[0]->json;
    }

}