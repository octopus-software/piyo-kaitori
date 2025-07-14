export const handleInput = (e: Event, field: string, setFieldValue: any) => {
    const target = e.target as HTMLInputElement | null;
    if (target) {
        setFieldValue(field, target.value);
    }
};
