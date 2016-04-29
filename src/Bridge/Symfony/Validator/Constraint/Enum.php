<?php

namespace Greg0ire\Enum\Bridge\Symfony\Validator\Constraint;

use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Exception\ConstraintDefinitionException;

/**
 * @Annotation
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
 *
 * @author Sullivan Senechal <soullivaneuh@gmail.com>
 */
final class Enum extends Choice
{
    /**
     * @var string
     */
    public $class;

    /**
     * @var bool
     */
    public $showKeys = false;

    /**
     * {@inheritdoc}
     */
    public function __construct($options = null)
    {
        parent::__construct($options);

        if (!is_a($this->class, 'Greg0ire\Enum\AbstractEnum', true)) {
            throw new ConstraintDefinitionException(
                'The option "enumClass" must be a class that inherits from Greg0ire\Enum\AbstractEnum'
            );
        }
        $this->choices = call_user_func(array($this->class, 'getConstants'));

        if ($this->showKeys) {
            $keysMessage = 'Valid '.$this->class.' constant keys are: '
                .implode(', ', call_user_func(array($this->class, 'getKeys'))).'.';
            $this->message .= ' '.$keysMessage;
            $this->multipleMessage .= ' '.$keysMessage;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function validatedBy()
    {
        return 'Symfony\Component\Validator\Constraints\ChoiceValidator';
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultOption()
    {
        return 'class';
    }

    /**
     * {@inheritdoc}
     */
    public function getRequiredOptions()
    {
        return array('class');
    }
}
