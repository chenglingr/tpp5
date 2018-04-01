//根据部门显示班级
$('.depart').change(function(){
	depart_name=$(this).val();

	url=SCOPE.grade_url;//bis view index.html
	postData={'depart':depart_name};
	$.post(url,postData,function(result){
		//相关业务处理
		
		if(result.status==1){
			data=result.data;
			grade_html="";
			$(data).each(function(i){
				grade_html+="<option value='"+this.id+"'>"+this.name+"</option>";
			
			});
			$('.se_grade_id').html(grade_html);
		}
		else if(result.status==0)
		{

			$('.se_grade_id').html("<option value='-1'>无可用班级</option>");
		}
		
	},'json');
});

$('.departall').change(function(){
	depart_name=$(this).val();

	url=SCOPE.grade_url;//bis view index.html
	postData={'depart':depart_name};
	$.post(url,postData,function(result){
		//相关业务处理
		
		if(result.status==1){
			data=result.data;
			grade_html="<option value='0'>---所有班级---</option>";
			$(data).each(function(i){
				grade_html+="<option value='"+this.id+"'>"+this.name+"</option>";
			
			});
			$('.se_grade_id').html(grade_html);
		}
		else if(result.status==0)
		{

			$('.se_grade_id').html("<option value='-1'>无可用班级</option>");
		}
		
	},'json');
});