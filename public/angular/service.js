angular.module('Subs').factory('Country',($http)=>{
    return {
        all: () => {
            return $http.get('/countries');
        }
    }
})
