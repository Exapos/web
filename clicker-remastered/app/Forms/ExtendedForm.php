<?php declare(strict_types=1);

namespace EveryBit\Forms;

use Nette\Application\UI as UI;
use Nette\Application\UI\Form;
use Nette\Forms\Controls\SelectBox;
use Nette\Forms\Controls\UploadControl;
use Nette\Forms\Validator;

class ExtendedForm extends UI\Form
{

    public static function setFormTranslation()
    {
        Validator::$messages = [
            Form::PROTECTION => 'generic.form-validator.csrf',
            Form::EQUAL => 'generic.form-validator.equal',
            Form::NOT_EQUAL => 'generic.form-validator.not-equal',
            Form::FILLED => 'thisFieldIsRequired',
            Form::BLANK => 'generic.form-validator.blank',
            Form::MIN_LENGTH => 'generic.form-validator.min-length',
            Form::MAX_LENGTH => 'generic.form-validator.max-length',
            Form::LENGTH => 'generic.form-validator.length',
            Form::EMAIL => 'generic.form-validator.email',
            Form::URL => 'generic.form-validator.url',
            Form::INTEGER => 'generic.form-validator.integer',
            Form::FLOAT => 'generic.form-validator.float',
            Form::MIN => 'generic.form-validator.min',
            Form::MAX => 'generic.form-validator.max',
            Form::RANGE => 'generic.form-validator.range',
            Form::MAX_FILE_SIZE => 'generic.form-validator.max-file-size',
            Form::MAX_POST_SIZE => 'generic.form-validator.max-post-size',
            Form::MIME_TYPE => 'generic.form-validator.mime-type',
            Form::IMAGE => 'generic.form-validator.image',
            SelectBox::VALID => 'generic.form-validator.select-valid',
            UploadControl::VALID => 'generic.form-validator.upload-valid',
        ];
    }

}
