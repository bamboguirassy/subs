angular.module('Subs', ['froala'], () => { })
    .value('froalaConfig', {
        toolbarBottom: true,
        toolbarInline: false,
        placeholderText: 'Renseigner le texte ici...',
        charCounterCount: false,
        codeMirror: true,
        fontFamilySelection: true,
        fontSizeSelection: true,
        attribution: false,
        inlineClasses: {
            'fr-class-code': 'Code',
            'fr-class-highlighted': 'Highlighted',
            'fr-class-transparency': 'Transparent'
        },
        inlineStyles: {
            'Big Red': 'font-size: 20px; color: red;',
            'Small Blue': 'font-size: 14px; color: blue;'
        },
        language: 'fr',
        linkAutoPrefix: 'https://',
        linkConvertEmailAddress: false,
        tableCellStyles: {
            table: 'Table',
            tableBordered: 'Avec bordure',
            tableStriped: 'Avec rayure',
            tableHover: 'Avec marqueur',
        },
    })
    .controller('ProgrammeNewController', ($scope) => {
        $scope.profils = [];
        $scope.programme = {};
        $scope.initVals = (profils) => {
            $scope.profils = profils;
            $scope.profils.forEach(type => type.selected = false);
        };
        $scope.selectProfil = (profil) => {
            profil.selected = !profil.selected;
        }
    });
