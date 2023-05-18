<?

namespace App\Traits;

use App\Exceptions\ApiException;
use Illuminate\Database\Eloquent\Model;

Trait HasPrincipal {

    // protected static $principalOver;

    protected static function bootHasPrincipal() {
        static::saving(function (Model $model) {
            if ($model->{static::getColumn()})
                $model->where(static::getRelationship(), $model->{static::getRelationship()})->update([static::getColumn() => false]);
        });
    }


    private static function getColumn() {
        return static::$principalColumn ?? 'principal';
    }

    private static function getRelationship() {
        if (!static::$principalOver)
            throw new ApiException('Error on getting relationship for principal attribute');
            
        return static::$principalOver;
    }
}