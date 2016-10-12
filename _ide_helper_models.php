<?php
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\Category
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property integer $left_key
 * @property integer $right_key
 * @property integer $level
 * @property string $cat_type
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereLeftKey($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereRightKey($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereLevel($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereCatType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Category whereUpdatedAt($value)
 */
	class Category extends \Eloquent {}
}

namespace App{
/**
 * App\Classes
 *
 * @property string $class
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Classes whereClass($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Classes whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Classes whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Classes whereUpdatedAt($value)
 */
	class Classes extends \Eloquent {}
}

namespace App{
/**
 * App\Client
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property integer $curator
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Client whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Client whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Client whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Client wherePhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Client whereCurator($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Client whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Client whereUpdatedAt($value)
 */
	class Client extends \Eloquent {}
}

namespace App{
/**
 * App\Field
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property string $value
 * @property string $default_value
 * @property integer $accessory_id
 * @property string $accessory_type
 * @property integer $param_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $accessory
 * @property-read \App\FieldParam $params
 * @method static \Illuminate\Database\Query\Builder|\App\Field whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Field whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Field whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Field whereValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Field whereDefaultValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Field whereAccessoryId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Field whereAccessoryType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Field whereParamId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Field whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Field whereUpdatedAt($value)
 */
	class Field extends \Eloquent {}
}

namespace App{
/**
 * App\FieldParam
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property string $default_value
 * @property string $description
 * @property string $accessory_type
 * @property boolean $is_many_values
 * @property boolean $is_required
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Field[] $fields
 * @method static \Illuminate\Database\Query\Builder|\App\FieldParam whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FieldParam whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FieldParam whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FieldParam whereDefaultValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FieldParam whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FieldParam whereAccessoryType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FieldParam whereIsManyValues($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FieldParam whereIsRequired($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FieldParam whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\FieldParam whereUpdatedAt($value)
 */
	class FieldParam extends \Eloquent {}
}

namespace App{
/**
 * App\Log
 *
 * @property integer $id
 * @property string $log_type
 * @property string $description
 * @property integer $user_id
 * @property string $params
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Log whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Log whereLogType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Log whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Log whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Log whereParams($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Log whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Log whereUpdatedAt($value)
 */
	class Log extends \Eloquent {}
}

namespace App{
/**
 * App\Permission
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Role[] $roles
 * @method static \Illuminate\Database\Query\Builder|\App\Permission whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Permission whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Permission whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Permission whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Permission whereUpdatedAt($value)
 */
	class Permission extends \Eloquent {}
}

namespace App{
/**
 * App\Ppc
 *
 * @property integer $id
 * @property string $code
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Ppc whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Ppc whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Ppc whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Ppc whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Ppc whereUpdatedAt($value)
 */
	class Ppc extends \Eloquent {}
}

namespace App{
/**
 * App\Product
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property float $price
 * @property float $cost
 * @property boolean $is_service
 * @property integer $balance
 * @property integer $stock_id
 * @property string $stock_type
 * @property integer $subdivision_id
 * @property string $subdivision_type
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product wherePrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereCost($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereIsService($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereBalance($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereStockId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereStockType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereSubdivisionId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereSubdivisionType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereUpdatedAt($value)
 */
	class Product extends \Eloquent {}
}

namespace App{
/**
 * App\Requisite
 *
 * @property integer $id
 * @property string $legal_name
 * @property string $bank
 * @property string $iik
 * @property string $bin
 * @property string $cbe
 * @property integer $relation_id
 * @property string $relation_type
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Requisite whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Requisite whereLegalName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Requisite whereBank($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Requisite whereIik($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Requisite whereBin($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Requisite whereCbe($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Requisite whereRelationId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Requisite whereRelationType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Requisite whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Requisite whereUpdatedAt($value)
 */
	class Requisite extends \Eloquent {}
}

namespace App{
/**
 * App\Role
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $special
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Permission[] $permissions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @method static \Illuminate\Database\Query\Builder|\App\Role whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Role whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Role whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Role whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Role whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Role whereSpecial($value)
 */
	class Role extends \Eloquent {}
}

namespace App{
/**
 * App\Setting
 *
 * @property string $name
 * @property string $value
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Setting whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Setting whereValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Setting whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Setting whereUpdatedAt($value)
 */
	class Setting extends \Eloquent {}
}

namespace App{
/**
 * App\Trade
 *
 * @property integer $id
 * @property integer $status
 * @property integer $ppc
 * @property integer $curator
 * @property integer $client_id
 * @property boolean $payment_is_completed
 * @property integer $completed_by_user
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Trade whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Trade whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Trade wherePpc($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Trade whereCurator($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Trade whereClientId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Trade wherePaymentIsCompleted($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Trade whereCompletedByUser($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Trade whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Trade whereUpdatedAt($value)
 */
	class Trade extends \Eloquent {}
}

namespace App{
/**
 * App\TradeStatus
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property integer $level
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\TradeStatus whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TradeStatus whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TradeStatus whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TradeStatus whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TradeStatus whereLevel($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TradeStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TradeStatus whereUpdatedAt($value)
 */
	class TradeStatus extends \Eloquent {}
}

namespace App{
/**
 * App\Type
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property integer $class_id
 * @property string $class_type
 * @property boolean $is_deleted
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Type whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Type whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Type whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Type whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Type whereClassId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Type whereClassType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Type whereIsDeleted($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Type whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Type whereUpdatedAt($value)
 */
	class Type extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Role[] $roles
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Field[] $fields
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $unreadNotifications
 * @method static \Illuminate\Database\Query\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

