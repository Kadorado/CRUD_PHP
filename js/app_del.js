function confirmDelete(){
    const response= confirm("¿estas seguro de que deseas eliminar el pais?");

    if (response ==true){
        return true
    }
    else{
        return false
    }
}
