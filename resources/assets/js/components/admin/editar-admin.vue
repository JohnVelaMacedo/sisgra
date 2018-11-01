<template>
	<div class="container">
        <div class="row">
        	<div class="col-md-12">
        		<div class="card">
        			
        		</div>
        	</div>
        </div>
    </div>
</template>
<script>
	export default 
	{
		data()
		{
			return 
			{

			}
		},
		methods:
		{
			getPersona()
			{
				axios.get('Persona')
			}
		}
	}
</script>