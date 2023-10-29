<?php

namespace App\Filament\Resources;

use App\Enums\Country;
use App\Enums\UserRole;
use App\Enums\WineType;
use App\Filament\Resources\WineResource\Pages;
use App\Models\Wine;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class WineResource extends Resource
{
    protected static ?string $model = Wine::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'Winery Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('winery_id')
                    ->relationship(
                        name: 'winery',
                        titleAttribute: 'legal_name',
                        modifyQueryUsing: fn (Builder $query) => $query->fromAuthUser(),
                    ),
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->label('Main Image')
                    ->required()
                    ->imageEditor(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('region')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('vintage')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->postfix('den.'),
                Forms\Components\Select::make('wine_type')
                    ->options([
                        WineType::RED->value => 'Red',
                        WineType::WHITE->value => 'White',
                        WineType::ROSE->value => 'Rose',
                        WineType::SPARKLING->value => 'Sparkling',
                        WineType::DESSERT->value => 'Dessert',
                    ])
                    ->required(),
                Forms\Components\Select::make('country')
                    ->options([
                        Country::AFG->value => 'Afghanistan',
                        Country::ALB->value => 'Albania',
                        Country::DZA->value => 'Algeria',
                        Country::ASM->value => 'American Samoa',
                        Country::AND->value => 'Andorra',
                        Country::AGO->value => 'Angola',
                        Country::AIA->value => 'Anguilla',
                        Country::ATA->value => 'Antarctica',
                        Country::ATG->value => 'Antigua and Barbuda',
                        Country::ARG->value => 'Argentina',
                        Country::ARM->value => 'Armenia',
                        Country::ABW->value => 'Aruba',
                        Country::AUS->value => 'Australia',
                        Country::AUT->value => 'Austria',
                        Country::AZE->value => 'Azerbaijan',
                        Country::BHS->value => 'Bahamas (the)',
                        Country::BHR->value => 'Bahrain',
                        Country::BGD->value => 'Bangladesh',
                        Country::BRB->value => 'Barbados',
                        Country::BLR->value => 'Belarus',
                        Country::BEL->value => 'Belgium',
                        Country::BLZ->value => 'Belize',
                        Country::BEN->value => 'Benin',
                        Country::BMU->value => 'Bermuda',
                        Country::BTN->value => 'Bhutan',
                        Country::BOL->value => 'Bolivia (Plurinational State of)',
                        Country::BES->value => 'Bonaire, Sint Eustatius and Saba',
                        Country::BIH->value => 'Bosnia and Herzegovina',
                        Country::BWA->value => 'Botswana',
                        Country::BVT->value => 'Bouvet Island',
                        Country::BRA->value => 'Brazil',
                        Country::IOT->value => 'British Indian Ocean Territory (the)',
                        Country::BRN->value => 'Brunei Darussalam',
                        Country::BGR->value => 'Bulgaria',
                        Country::BFA->value => 'Burkina Faso',
                        Country::BDI->value => 'Burundi',
                        Country::CPV->value => 'Cabo Verde',
                        Country::KHM->value => 'Cambodia',
                        Country::CMR->value => 'Cameroon',
                        Country::CAN->value => 'Canada',
                        Country::CYM->value => 'Cayman Islands (the)',
                        Country::CAF->value => 'Central African Republic (the)',
                        Country::TCD->value => 'Chad',
                        Country::CHL->value => 'Chile',
                        Country::CHN->value => 'China',
                        Country::CXR->value => 'Christmas Island',
                        Country::CCK->value => 'Cocos (Keeling) Islands (the)',
                        Country::COL->value => 'Colombia',
                        Country::COM->value => 'Comoros (the)',
                        Country::COD->value => 'Congo (the Democratic Republic of the)',
                        Country::COG->value => 'Congo (the)',
                        Country::COK->value => 'Cook Islands (the)',
                        Country::CRI->value => 'Costa Rica',
                        Country::HRV->value => 'Croatia',
                        Country::CUB->value => 'Cuba',
                        Country::CUW->value => 'Curaçao',
                        Country::CYP->value => 'Cyprus',
                        Country::CZE->value => 'Czechia',
                        Country::CIV->value => "Côte d'Ivoire",
                        Country::DNK->value => 'Denmark',
                        Country::DJI->value => 'Djibouti',
                        Country::DMA->value => 'Dominica',
                        Country::DOM->value => 'Dominican Republic (the)',
                        Country::ECU->value => 'Ecuador',
                        Country::EGY->value => 'Egypt',
                        Country::SLV->value => 'El Salvador',
                        Country::GNQ->value => 'Equatorial Guinea',
                        Country::ERI->value => 'Eritrea',
                        Country::EST->value => 'Estonia',
                        Country::SWZ->value => 'Eswatini',
                        Country::ETH->value => 'Ethiopia',
                        Country::FLK->value => 'Falkland Islands (the) [Malvinas]',
                        Country::FRO->value => 'Faroe Islands (the)',
                        Country::FJI->value => 'Fiji',
                        Country::FIN->value => 'Finland',
                        Country::FRA->value => 'France',
                        Country::GUF->value => 'French Guiana',
                        Country::PYF->value => 'French Polynesia',
                        Country::ATF->value => 'French Southern Territories (the)',
                        Country::GAB->value => 'Gabon',
                        Country::GMB->value => 'Gambia (the)',
                        Country::GEO->value => 'Georgia',
                        Country::DEU->value => 'Germany',
                        Country::GHA->value => 'Ghana',
                        Country::GIB->value => 'Gibraltar',
                        Country::GRC->value => 'Greece',
                        Country::GRL->value => 'Greenland',
                        Country::GRD->value => 'Grenada',
                        Country::GLP->value => 'Guadeloupe',
                        Country::GUM->value => 'Guam',
                        Country::GTM->value => 'Guatemala',
                        Country::GGY->value => 'Guernsey',
                        Country::GIN->value => 'Guinea',
                        Country::GNB->value => 'Guinea-Bissau',
                        Country::GUY->value => 'Guyana',
                        Country::HTI->value => 'Haiti',
                        Country::HMD->value => 'Heard Island and McDonald Islands',
                        Country::VAT->value => 'Holy See (the)',
                        Country::HND->value => 'Honduras',
                        Country::HKG->value => 'Hong Kong',
                        Country::HUN->value => 'Hungary',
                        Country::ISL->value => 'Iceland',
                        Country::IND->value => 'India',
                        Country::IDN->value => 'Indonesia',
                        Country::IRN->value => 'Iran (Islamic Republic of)',
                        Country::IRQ->value => 'Iraq',
                        Country::IRL->value => 'Ireland',
                        Country::IMN->value => 'Isle of Man',
                        Country::ISR->value => 'Israel',
                        Country::ITA->value => 'Italy',
                        Country::JAM->value => 'Jamaica',
                        Country::JPN->value => 'Japan',
                        Country::JEY->value => 'Jersey',
                        Country::JOR->value => 'Jordan',
                        Country::KAZ->value => 'Kazakhstan',
                        Country::KEN->value => 'Kenya',
                        Country::KIR->value => 'Kiribati',
                        Country::XKS->value => 'Kosovo',
                        Country::PRK->value => "Korea (the Democratic People's Republic of)",
                        Country::KOR->value => 'Korea (the Republic of)',
                        Country::KWT->value => 'Kuwait',
                        Country::KGZ->value => 'Kyrgyzstan',
                        Country::LAO->value => "Lao People's Democratic Republic (the)",
                        Country::LVA->value => 'Latvia',
                        Country::LBN->value => 'Lebanon',
                        Country::LSO->value => 'Lesotho',
                        Country::LBR->value => 'Liberia',
                        Country::LBY->value => 'Libya',
                        Country::LIE->value => 'Liechtenstein',
                        Country::LTU->value => 'Lithuania',
                        Country::LUX->value => 'Luxembourg',
                        Country::MAC->value => 'Macao',
                        Country::MKD->value => 'Macedonia',
                        Country::MDG->value => 'Madagascar',
                        Country::MWI->value => 'Malawi',
                        Country::MYS->value => 'Malaysia',
                        Country::MDV->value => 'Maldives',
                        Country::MLI->value => 'Mali',
                        Country::MLT->value => 'Malta',
                        Country::MHL->value => 'Marshall Islands (the)',
                        Country::MTQ->value => 'Martinique',
                        Country::MRT->value => 'Mauritania',
                        Country::MUS->value => 'Mauritius',
                        Country::MYT->value => 'Mayotte',
                        Country::MEX->value => 'Mexico',
                        Country::FSM->value => 'Micronesia (Federated States of)',
                        Country::MDA->value => 'Moldova (the Republic of)',
                        Country::MCO->value => 'Monaco',
                        Country::MNG->value => 'Mongolia',
                        Country::MNE->value => 'Montenegro',
                        Country::MSR->value => 'Montserrat',
                        Country::MAR->value => 'Morocco',
                        Country::MOZ->value => 'Mozambique',
                        Country::MMR->value => 'Myanmar',
                        Country::NAM->value => 'Namibia',
                        Country::NRU->value => 'Nauru',
                        Country::NPL->value => 'Nepal',
                        Country::NLD->value => 'Netherlands (the)',
                        Country::NCL->value => 'New Caledonia',
                        Country::NZL->value => 'New Zealand',
                        Country::NIC->value => 'Nicaragua',
                        Country::NER->value => 'Niger (the)',
                        Country::NGA->value => 'Nigeria',
                        Country::NIU->value => 'Niue',
                        Country::NFK->value => 'Norfolk Island',
                        Country::MNP->value => 'Northern Mariana Islands (the)',
                        Country::NOR->value => 'Norway',
                        Country::OMN->value => 'Oman',
                        Country::PAK->value => 'Pakistan',
                        Country::PLW->value => 'Palau',
                        Country::PSE->value => 'Palestine, State of',
                        Country::PAN->value => 'Panama',
                        Country::PNG->value => 'Papua New Guinea',
                        Country::PRY->value => 'Paraguay',
                        Country::PER->value => 'Peru',
                        Country::PHL->value => 'Philippines (the)',
                        Country::PCN->value => 'Pitcairn',
                        Country::POL->value => 'Poland',
                        Country::PRT->value => 'Portugal',
                        Country::PRI->value => 'Puerto Rico',
                        Country::QAT->value => 'Qatar',
                        Country::ROU->value => 'Romania',
                        Country::RUS->value => 'Russian Federation (the)',
                        Country::RWA->value => 'Rwanda',
                        Country::REU->value => 'Réunion',
                        Country::BLM->value => 'Saint Barthélemy',
                        Country::SHN->value => 'Saint Helena, Ascension and Tristan da Cunha',
                        Country::KNA->value => 'Saint Kitts and Nevis',
                        Country::LCA->value => 'Saint Lucia',
                        Country::MAF->value => 'Saint Martin (French part)',
                        Country::SPM->value => 'Saint Pierre and Miquelon',
                        Country::VCT->value => 'Saint Vincent and the Grenadines',
                        Country::WSM->value => 'Samoa',
                        Country::SMR->value => 'San Marino',
                        Country::STP->value => 'Sao Tome and Principe',
                        Country::SAU->value => 'Saudi Arabia',
                        Country::SEN->value => 'Senegal',
                        Country::SRB->value => 'Serbia',
                        Country::SYC->value => 'Seychelles',
                        Country::SLE->value => 'Sierra Leone',
                        Country::SGP->value => 'Singapore',
                        Country::SXM->value => 'Sint Maarten (Dutch part)',
                        Country::SVK->value => 'Slovakia',
                        Country::SVN->value => 'Slovenia',
                        Country::SLB->value => 'Solomon Islands',
                        Country::SOM->value => 'Somalia',
                        Country::ZAF->value => 'South Africa',
                        Country::SGS->value => 'South Georgia and the South Sandwich Islands',
                        Country::SSD->value => 'South Sudan',
                        Country::ESP->value => 'Spain',
                        Country::LKA->value => 'Sri Lanka',
                        Country::SDN->value => 'Sudan (the)',
                        Country::SUR->value => 'Suriname',
                        Country::SJM->value => 'Svalbard and Jan Mayen',
                        Country::SWE->value => 'Sweden',
                        Country::CHE->value => 'Switzerland',
                        Country::SYR->value => 'Syrian Arab Republic',
                        Country::TWN->value => 'Taiwan (Province of China)',
                        Country::TJK->value => 'Tajikistan',
                        Country::TZA->value => 'Tanzania, United Republic of',
                        Country::THA->value => 'Thailand',
                        Country::TLS->value => 'Timor-Leste',
                        Country::TGO->value => 'Togo',
                        Country::TKL->value => 'Tokelau',
                        Country::TON->value => 'Tonga',
                        Country::TTO->value => 'Trinidad and Tobago',
                        Country::TUN->value => 'Tunisia',
                        Country::TUR->value => 'Turkey',
                        Country::TKM->value => 'Turkmenistan',
                        Country::TCA->value => 'Turks and Caicos Islands (the)',
                        Country::TUV->value => 'Tuvalu',
                        Country::UGA->value => 'Uganda',
                        Country::UKR->value => 'Ukraine',
                        Country::ARE->value => 'United Arab Emirates (the)',
                        Country::GBR->value => 'United Kingdom of Great Britain and Northern Ireland (the)',
                        Country::UMI->value => 'United States Minor Outlying Islands (the)',
                        Country::USA->value => 'United States of America (the)',
                        Country::URY->value => 'Uruguay',
                        Country::UZB->value => 'Uzbekistan',
                        Country::VUT->value => 'Vanuatu',
                        Country::VEN->value => 'Venezuela (Bolivarian Republic of)',
                        Country::VNM->value => 'Viet Nam',
                        Country::VGB->value => 'Virgin Islands (British)',
                        Country::VIR->value => 'Virgin Islands (U.S.)',
                        Country::WLF->value => 'Wallis and Futuna',
                        Country::ESH->value => 'Western Sahara',
                        Country::YEM->value => 'Yemen',
                        Country::ZMB->value => 'Zambia',
                        Country::ZWE->value => 'Zimbabwe',
                        Country::ALA->value => 'Åland Islands',
                    ])
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('alcohol_content')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('size_liters')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('winery.legal_name'),
                Tables\Columns\ImageColumn::make('image')
                    ->label('Main Image'),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('region')
                    ->searchable(),
                Tables\Columns\TextColumn::make('vintage')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->money('den')
                    ->summarize(Tables\Columns\Summarizers\Average::make())
                    ->sortable(),
                Tables\Columns\TextColumn::make('wine_type_name')
                    ->numeric()
                    ->sortable()
                    ->label('Wine type'),
                Tables\Columns\TextColumn::make('country_name')
                    ->numeric()
                    ->sortable()
                    ->label('Country'),
                Tables\Columns\TextColumn::make('alcohol_content')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('size_liters')
                    ->numeric()
                    ->sortable()
                    ->label('Size in liters'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('winery')
                    ->relationship('winery', 'legal_name')
                    ->multiple(),
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_from'),
                        DatePicker::make('created_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->groups([
                'winery.legal_name',
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->reorderable('sort');
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->when(auth()->user()->role->value === UserRole::WINERY->value, function ($query) {
                $query->fromAuthWinery();
            })
            ->orderBy('sort')
            ->latest();
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageWines::route('/'),
        ];
    }
}
