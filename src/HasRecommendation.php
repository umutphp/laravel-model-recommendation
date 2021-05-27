<?php
namespace Umutphp\LaravelModelRecommendation;

use Umutphp\LaravelModelRecommendation\RecommendationsModel;
use Illuminate\Support\Facades\DB;

/**
 * Interface class
 */
trait HasRecommendation
{
    /**
     * Generate recommendtaions and save it to the table
     *
     * @return void
     */
    public function generateRecommendations()
    {
        $table      = self::getRecommendationDataTable();
        $groupField = self::getRecommendationGroupField();
        $dataField  = self::getRecommendationDataField();
        $dataCount  = self::getRecommendationCount();

        $data = DB::table($table)
            ->select($groupField . ' as group_field', $dataField . ' as data_field')
            ->get();

        $dataLinearRanks    = [];
        $dataCartesianRanks = [];
        $recommendations    = [];
        $dataGroup          = [];

        foreach ($data as $value) {
            if (!isset($dataLinearRanks[$value->data_field])) {
                $dataLinearRanks[$value->data_field] = 0;
            }

            $dataLinearRanks[$value->data_field] += 1;

            if (!isset($dataGroup[$value->group_field])) {
                $dataGroup[$value->group_field] = [];
            }

            $dataGroup[$value->group_field][] = $value->data_field;
        }
        
        foreach ($dataGroup as $group) {
            foreach ($group as $data1) {
                foreach ($group as $data2) {
                    if (!isset($dataCartesianRanks[$data1])) {
                        $dataCartesianRanks[$data1] = [];
                    }

                    if (!isset($dataCartesianRanks[$data1][$data2])) {
                        $dataCartesianRanks[$data1][$data2] = 0;
                    }

                    $dataCartesianRanks[$data1][$data2] += 1;
                }
            }
        }

        // Generate recommendation list by sorting
        foreach ($dataCartesianRanks as $data1 => $data) {
            rsort($data);

            $data                    = array_slice($data, 0, $dataCount);
            $recommendations[$data1] = $data;
        }

        foreach ($recommendations as $data1 => $data) {
            foreach ($data as $order => $data2) {
                RecommendationsModel::where('source_type', self::class)->where('source_id', $data1)->delete();

                $recommendation = new RecommendationsModel(
                    [
                        'source_type'  => self::class,
                        'source_id'    => $data1,
                        'target_type'  => self::class,
                        'target_id'    => $data2,
                        'order_column' => $order
                    ]
                );
                $recommendation->save();
            }
        }
    }

    /**
     * Return the list of recommended models
     *
     * @return void
     */
    public function getRecommendations()
    {
        $recommendations = RecommendationsModel::where('source_type', self::class)
            ->where('target_type', self::class)->get();

        $return = collect();

        foreach ($recommendations as $recommendation) {
            $model  = app($recommendation->target_type);
            $target = $model->where('id', $id)->first();

            $return->push($target);
        }

        return $return;
    }
}
