<script>
document.addEventListener('DOMContentLoaded', function() {
    // Selecciona todos los botones de eliminar
    const deleteButtons = document.querySelectorAll('.delete-btn');
    
    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const customerId = this.getAttribute('data-id');
            
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to reverse this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, remove it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirige para eliminar si se confirma
                    window.location.href = `../admin/delete_customer.php?id=${customerId}`;

                    Swal.fire({
                    title: "Removed!",
                    icon: "success",
                    draggable: true
                    });
                    
                    // Opcional: Mostrar mensaje de éxito (se ejecutará después de la redirección)
                    // En delete_customer.php deberás manejar esto con sesiones
                }
            });
        });
    });
});
</script>