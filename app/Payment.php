<?php


namespace App;


use App\Utils\NumberUtils;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class Payment extends Model
{

    protected $table = 'payments';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->identifier = Str::random();
    }

    /**
     * @var Collection
     */
    private $metas;

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'session_id';
    }

    /**
     * @return string
     */
    public function formatToSend() {
        return NumberUtils::format($this->to_send / pow(10, 3), 3, '.', '') . ' ' . strtoupper($this->crypto);
    }

    /**
     * @param bool $refresh
     * @return Collection
     */
    public function getMetas($refresh = false) {
        if (!$this->metas || $refresh) {
            $this->metas = PaymentMeta::query()
                ->where('payment_id', $this->id)
                ->get()
                ->pluck('meta_value', 'meta_key');
        }

        return $this->metas;
    }

    public function __toString()
    {
        return 'Payment [i=' . $this->identifier . ', s=' . $this->status . ']';
    }
}
