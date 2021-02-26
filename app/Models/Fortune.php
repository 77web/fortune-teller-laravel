<?php

namespace App\Models;

use App\Domain\FortuneInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fortune extends Model implements FortuneInterface
{
    use HasFactory;

    protected $table = 'fortunes';

    protected $attributes = [
        'target_date' => null,
        'target_sign' => '',
        'fortune_text' => '',
    ];

    public function getTargetDate(): ?\DateTimeImmutable
    {
        if($date = $this->getAttribute('target_date')) {
            return new \DateTimeImmutable((string) $date);
        }

        return null;
    }

    public function getTargetSign(): ?string
    {
        return $this->getAttribute('target_sign');
    }

    public function getFortuneText(): ?string
    {
        return $this->getAttribute('fortune_text');
    }
}
